<?php

use App\Cms\Page;


$post = new Page();

$post->title = "Bread of Life";
$post->subtitle = 'Still Hungry?';
$post->slug = 'bread';
$post->id = 4;
$post->intro = '"I am the bread of life. Whoever comes to me will never become hungry, and whoever believes in me will never become thirsty" (John 6:35 ISV)';
$post->image = '/assets/paper_theme_v2/img/post/bread_0.jpg';
/*$post->images = [
    '/assets/paper_theme_v2/img/post/bread_0.jpg',
    '/assets/paper_theme_v2/img/post/bread_1.jpg',
    '/assets/paper_theme_v2/img/post/bread_2.jpg',
    '/assets/paper_theme_v2/img/post/bread_3.jpg',
];*/
$post->video = 'pHyrJAhLVTc';

// content
$post->content = '
<h2>Bread of Life</h2>
<p>“It is written,</p>
<p class="mx-5">‘One must not live on bread alone,
    but on every word coming
        out of the mouth of God.’”</p>
<p class="spiritual-quote">MATTHEW 4:4 ISV</p>
</br>
<p><sup>25</sup> That’s why I’m telling you to stop worrying about your life—what
you will eat or what you will drink—or about your body—what you will wear.
Life is more than food, isn’t it, and the body more than clothing? <sup>26</sup>
Look at the birds in the sky. They don’t plant or harvest or gather
food into barns, and yet your heavenly Father feeds them. You are more
valuable than they are, aren’t you? <sup>27</sup> Can any of you add a single hour
to the length of your life by worrying?<p>
<p class="spiritual-quote">MATTHEW 6:25-27 ISV</p>
</br>
<p>How blessed are those who are hungry and thirsty for righteousness,
    because it is they who will be satisfied!</p>
<p class="spiritual-quote">MATTHEW 5:6 ISV</p>
</br>
<p><sup>26</sup> Jesus replied to them, “Truly, I tell all of you[a] emphatically,
you are looking for me, not because you saw signs, but because you ate
the loaves and were completely satisfied. <sup>27</sup> Do not work for food that
perishes but for food that lasts for eternal life, which the Son of Man
will give you, because God the Father has set his seal on him.”</p>
<p class="spiritual-quote">JOHN 6:26-27 ISV</p>
</br>
<p><sup>31</sup>Our ancestors ate the manna in the wilderness, just as it is written,</p>
<p class="mx-5">‘He gave them bread from heaven to eat.’</p>
<p> <sup>32</sup> Jesus told them, “Truly, I tell
all of you emphatically, it was not Moses who gave you the bread from heaven, but it
is my Father who gives you the true bread from heaven. <sup>33</sup> The bread of God
is the one who comes down from heaven and gives life to the world.” <sup>34</sup> Then they told
him, “Sir, give us this bread all the time.” <sup>35</sup> Jesus told them, “I am the bread of life.
Whoever comes to me will never become hungry, and whoever believes in me will never become thirsty.</p>
<p class="spiritual-quote">JOHN 6:31-35 ISV</p>
</br>
<p><sup>47</sup>Truly, I tell all of you emphatically, the one who believes in me has
eternal life. <sup>48</sup> I’m the bread of life. <sup>49</sup> Your ancestors ate the manna in the wilderness
and died. <sup>50</sup> This is the bread that comes down from heaven, so that a person may eat it
and not die. <sup>51</sup> I’m the living bread that came down from heaven. If anyone eats this bread,
he’ll live forever. And the bread I will give for the life of the world is my flesh.”</p>
<p class="spiritual-quote">JOHN 6:47-51 ISV</p>
</br>
<p><sup>6</sup> Never worry about anything. Instead, in every situation let your petitions be made
known to God through prayers and requests, with thanksgiving. <sup>7</sup> Then God’s peace, which
goes far beyond anything we can imagine, will guard your hearts and minds in union with
the Messiah Jesus.</p>
<p class="spiritual-quote">PHILIPPIANS 4:6-7 ISV</p>
</br>
';

// display settings
// @todo not sure about this format yet
$post->settings = [
    // 'template' => 'one_column' // template to use
];


return $post;
