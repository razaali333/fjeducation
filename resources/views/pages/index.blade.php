@extends('layouts.app')

@section('title', 'Welcome to EDINNO')

@section('content')
<section id="hero" class="hero">
    <div class="hero-content">
        <h1>Contribute into your future success today</h1>
        <p>Push up your business and skills using our education platform</p>
        <a href="#" class="cta-button">Start now</a>
    </div>
    <div class="hero-image">
        <img src="images/start-img.png" alt="Graduates">
    </div>
</section>

<section id="opportunities" class="opportunities">
    <div class="wave-background">
       <img src="{{asset('images/oppertunity.svg')}}" alt="">
        {{-- <img src="images/wave.svg" alt="Wave Background"> --}}
    </div>
    <div class="opportunities-content">
        <h2>Our opportunities</h2>
        <p>Through many years of research and our own experience, we’ve selected a useful library of books to help you figure out how to make your life better. Learn to manage successful deals and find better solutions for your business. If you are a visual learner, you can also check our selection of educational lectures in video tutorials.</p>
    </div>
</section>

<section id="cards-section" class="cards-section">
    <div class="cards-card">
        <h3>Online shop with lots of useful e-books</h3>
        <img src="images/ebooks.png" alt="E-books">
        <a href="#" class="cta-button1">Get e-books <img class="arrow-btn" src="images/arrow-left.svg" alt=""></a>
    </div>
    <div class="cards-card">
        <h3>Catalog of educational videos online</h3>
        <img src="images/video.png" alt="Videos">
        <a href="#" class="cta-button1">Get videos <img class="arrow-btn" src="images/arrow-left.svg" alt=""></a>
    </div>
</section>

<section id="market" class="market-research">
    <h2>Market research</h2>
    <p>Brokers usually spend so much time looking for information about market trends and trying to predict the next big deals. To simplify this process, we have collected all useful services in one place.</p>
</section>


<section id="cards-section" class="cards-section">
    <div class="card">
        <div class="card-icon" style="background-color: #FFC107;"><img src="images/step-1.png" alt=""></div>
        <h3>Original content</h3>
        <p>We provide only exclusive learning materials and video tutorials for your convenience.</p>
    </div>
    <div class="card">
        <div class="card-icon" style="background-color: #757575;"><img src="images/step-2.png" alt=""></div>
        <h3>Expert programs</h3>
        <p>Studying programs are designed and developed according to expert advice and mentoring.</p>
    </div>
    <div class="card">
        <div class="card-icon" style="background-color: #00C4CC;"><img src="images/step-3.png" alt=""></div>
        <h3>Ultimate source</h3>
        <p>We are available for both beginners and pros in the niche. Expand your knowledge with us.</p>
    </div>
    <div class="card">
        <div class="card-icon" style="background-color: #757575;"><img src="images/step-4.png" alt=""></div>
        <h3>Better solutions</h3>
        <p>Discover new approaches and methods for improving your business by using our library and lectures.</p>
    </div>
</section>

<section id="faq" class="faq-section">
    <h2 class="faq-title">F.A.Q.</h2>
    <div class="faq-item">
        <button class="faq-question" onclick="toggleAnswer(1)">
            Why should I start using your service?
            <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer" id="faq-answer-1">
            <p>Our service provides you with exclusive content, expert programs, and a user-friendly platform to enhance your learning experience.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question" onclick="toggleAnswer(2)">
            How is your platform better than any other e-learning service?
            <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer" id="faq-answer-2">
            <p>We offer a wide range of high-quality educational materials, personalized learning paths, and excellent customer support to ensure the best learning experience.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question" onclick="toggleAnswer(3)">
            How can I start reading books and watching videos?
            <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer" id="faq-answer-3">
            <p>Simply sign up for an account, browse our library, and start enjoying our content immediately.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question" onclick="toggleAnswer(4)">
            What content types can I use?
            <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer" id="faq-answer-4">
            <p>You can access e-books, video tutorials, and interactive courses to enhance your learning.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question" onclick="toggleAnswer(5)">
            Does your service have any restrictions?
            <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer" id="faq-answer-5">
            <p>Our service is available to all users worldwide without any restrictions.</p>
        </div>
    </div>
    <div class="faq-item">
        <button class="faq-question" onclick="toggleAnswer(6)">
            What should I do if I have questions about access?
            <span class="faq-icon">+</span>
        </button>
        <div class="faq-answer" id="faq-answer-6">
            <p>If you have any questions, please contact our support team for assistance.</p>
        </div>
    </div>

    <!-- SVG Wave Image -->
    <div class="svg-wave-container">
        <img src="images/faq-bg.svg" alt="SVG Wave" class="svg-wave">
    </div>
</section>

<section id="signup-section" class="signup-section">
    <div class="signup-content">
        <h2>Sign up and get best materials you have ever seen</h2>
        <p>20k+ students daily learn with MasterCourse</p>
        <button class="signup-button">Get started</button>
    </div>
    <div class="decorative-images">
        <img src="images/st1.png" alt="Student 1" class="student student1">
        <img src="images/st2.png" alt="Student 2" class="student student2">
        <img src="images/st3.png" alt="Student 2" class="student student3">
        <img src="images/st4.png" alt="Student 3" class="student student4">
        <img src="images/st5.png" alt="Student 4" class="student student5">

    </div>
    <img src="images/promo-book.png" alt="Books" class="books">
</section>
@endsection
