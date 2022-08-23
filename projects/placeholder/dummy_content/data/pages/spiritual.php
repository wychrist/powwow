<?php

use App\Cms\Page;

$page = new Page();

$page->template = 'theme::templates/privacy';
$page->title = "Our Belief of Faith";
$page->slug  = "spiritual";
$page->content = '
<div class="container">
    <h1>Our Belief of Faith</h1>
    <ul class="spiritual-li" >
        <li>
            There exists one true, loving, and eternal God, who created all things
            and sustains all things.
            <p class="spiritual-quote">John 1:1-3; Hebrews 1:3</p>
        </li>
        <li>
            Though God is one, he exists in three persons: God the Father, God the Son, and God the Holy Spirit.
            <p class="spiritual-quote">Matthew 28:19</p>
        </li>
        <li>
            We can know there is a God by His creation and learn of His love and concern for us through his word, the Bible.
            <p class="spiritual-quote">Romans 1:20; John 3:16</p>
        </li>
        <li>
            The Bible is the story of the ultimate meaning, purpose, and direction for mankind, inspired by God himself.
            <p class="spiritual-quote">Psalm 8:4; Psalm 119-105</p>
        </li>
        <li>
            Man and women were created by God in his own image, united in a perfect loving relationship with him.
            <p class="spiritual-quote">Genesis 1:27</p>
        </li>
        <li>
            God gave Mankind free will.
            <p class="spiritual-quote">Joshua 24:15</p>
        </li>
        <li>
            Satan deceived Adam and Eve into breaking God\'s command for them, they (sinned) and by doing so broke that relationship. The consequence of sin is separation from God, and because of this, death.
            <p class="spiritual-quote">Genesis 3:4-5; Genesis 3:19; Genesis 3:24</p>
        </li>
        <li>
            God sent Jesus into this world to make a way for the relationship to be restored.
            <p class="spiritual-quote">Luke 19:9-10; Galatians 4:4</p>
        </li>
        <li>
            Jesus was crucified and received the punishment of death and separation from God, in our place.
            <p class="spiritual-quote">1 Peter 2:24</p>
        </li>
        <li>
            God raised Jesus back to life after three days. Through his resurrection Jesus defeated death.
            <p class="spiritual-quote">Mark 8:1; 1 Corinthians 15:55-57; 1 Corinthians 15:20-22</p>
        </li>
        <li>
            We are made right with God, and the relationship with him is restored, when we accept and trust in Christ by confessing our faith in Him, repent of our sins and are baptized (immersed) into Him for forgiveness of our sins.
            <p class="spiritual-quote">Romans 10:9; Acts 2:38</p>
        </li>
        <li>
            When we decide to follow Jesus, the spirit of God (the Holy Spirit) is given to us as a gift, to have a living presence in each of us, helping us live our lives according to God\'s will.
            <p class="spiritual-quote">Acts 2:38-39; Romans 5:5</p>
        </li>
        <li>
            The core principle in following Jesus is placing God\'s will above our own will in our lives and trusting Him. Jesus gave us the perfect example of this in his own life.
            <p class="spiritual-quote">Galatians 2:20; Matthew 6:33; Luke 22:41-42</p>
        </li>
        <li>
            Satan is actively at work to entice us into doubting God and turn away from Him.
            <p class="spiritual-quote">1 Peter 5:8; Mathew 16:23</p>
        </li>
        <li>
            The church consists of those who follow Jesus, and collectively, continues the work of Jesus fulfilling the mission of God in the world today.
            <p class="spiritual-quote">1 Corinthians 1:2; 1 Timothy 3:14-15; Mathew 28 18-20</p>
        </li>
        <li>
            We are saved by grace through faith but our faith needs to be characterised by good works.
            <p class="spiritual-quote">Ephesians 2:8; James 2:14-26</p>
        </li>
        <li>
            The church consists of those who follow Jesus, and collectively, continues the work of Jesus fulfilling the mission of God in the world today.
            <p class="spiritual-quote">Ephesians 2:8; James 2:14-26</p>
        </li>
        <li>
            Jesus will return one day to complete God\'s mission. All evil (opposition to God) will be defeated completely and forever, and all His followers will be raised to live eternally with Him in heaven. There will be no more pain, suffering or sorrow.
            <p class="spiritual-quote">Matthew 24:36-44; 1 Corinthians 15:50-54; Revelation 21:4; John 14-1</p>
        </li>
    </ul>
    <p>Last updated: December 17th, 2021</p>
    <p>Original document converted for web: August 23rd, 2022</p>
</div>
';


return $page;
