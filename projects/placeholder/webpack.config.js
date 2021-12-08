var Encore = require('@symfony/webpack-encore');

Encore.setOutputPath('web/build')
      .setPublicPath('/build');

// Entry points
Encore.addEntry('app','./private/app/web/js/main.js');


Encore
 .disableSingleRuntimeChunk()
//.enableSingleRuntimeChunk()
.cleanupOutputBeforeBuild()
.enableSourceMaps(!Encore.isProduction())
.enableTypeScriptLoader()
.enableSassLoader()
.autoProvidejQuery()
.enableVersioning(Encore.isProduction())

module.exports = Encore.getWebpackConfig();