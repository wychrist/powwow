var createError = require('http-errors');
var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');

var indexRouter = require('./routes/index');
var usersRouter = require('./routes/users');
var cors = require('cors')

var app = express();

const server = require('http').createServer(app);
const io = require('socket.io')(server, {
  cors: {
    origin: 'http://192.168.20.20:8080',
    methods: ['GET', 'POST', 'PUT']
  }
});

app.use(cors())


/* io.use((socket, next) => {
  // sessionMiddleware(socket.request, socket.request.res, next); will not work with websocket-only
  // connections, as 'socket.request.res' will be undefined in that case
}); */

const connectedSockets = {}
let count = 1;

/* setInterval(() => {
  count++;
  console.log('updating clients: ' + count)
}, 5000);*/

io.on('connection', (socket) => {
  console.log('client connected: ' + socket.id)
});

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'pug');

app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

app.use('/', indexRouter);
app.use('/users', usersRouter);

function sendSection(section) {
  io.emit('section', {
    content: section
  })
}

indexRouter.post('/section', function (req, res, next) {
  sendSection(req.body.content)

  res.send({
    success: true
  })
});

app.use(function(req, res, next) {
  next(createError(404));
});

// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});

module.exports = server;
