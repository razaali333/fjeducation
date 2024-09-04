@extends('layouts.app')

@section('title', 'Welcome to EDINNO')
<link rel="stylesheet" href="{{ asset('style/card.css') }}">
@section('content')
<style>
    .container{
        max-width: 1280px;
    width: 100%;
    margin-left: auto;
    margin-right: auto;
    text-align: left;
    }
    p,h3,h2,h4{
        margin: 0;
    }
    h2{
        margin-top: 5px;
    }
    ul,p,h4{
        line-height: 1.15;
    }
    ul, ol {
    list-style: none;
    padding: 0;
}
@media screen and (max-width: 576px) {
    .section-content {
        max-width: calc(100% - 32px) !important;
        margin: auto;
    }
}
</style>
<section >
    <div class="section-content">
       <div class="container">
        <div class="article-body " style="color: #fff;">
            <h1 class="main">Terms & Conditions Fujtrade </h1>
            <br>
            <h4>Introduction</h4>
            <br>
            <p>
                Welcome to fjeducation.com. This website is owned and operated by Fujtrade. By visiting
                our website and accessing the information, resources, services, products, and tools we provide,
                you understand and agree to accept and adhere to the following terms and conditions as stated in
                this policy (hereafter referred to as 'User Agreement'), along with the terms and conditions as
                stated in our Privacy Policy (please refer to the Privacy Policy section below for more
                information).
                The following text describes the terms and conditions for use of this website and the services
                related to it, as created and operated by Fujtrade. Please read it carefully. By using
                this website, you indicate that you accept to be bound by these terms and conditions. Fujtrade
                may revise and update these terms and conditions at any time, so please visit this page
                periodically to review the text, as it is binding on you. The terms "You" and "User" are used
                throughout the text with reference to all individuals and/or entities accessing this website for
                any purpose or reasons.
            </p>
            <br>
            <h4>Use of Content and Proprietary Rights</h4>
            <br>
            <p>
                By using this website you acknowledge and agree that all content and material available on it,
                such as text, logos, graphics, images, and software, are protected under Norwegian and
                international copyright, trademark and other laws. All content and material are the property of
                Fujtrade or its content suppliers or clients. Fujtrade reserves the exclusive right
                to the compilation of the content of this website (meaning its collection, arrangement and
                display). This right is protected by Norwegian and international copyright laws. By using this
                website you agree not to capture, sell, license, distribute, publish, modify, adapt, edit, copy,
                reproduce, or reuse the content of this website in any other way for any public or commercial
                purpose. You are prohibited to copy or adapt the HTML code that Fujtrade creates and uses
                to generate its web pages. This code is also protected by the copyright. You are expressly
                prohibited to violate the security of this website (for example by way of, but not limited to,
                using any device, software or procedure that interferes or attempts to interfere with the proper
                functioning of this website; using any device or tool to navigate this website other than that
                provided by Fujtrade; attempting to decipher, decompile, disassemble or reverse engineer
                any of the software making up a part of the website; spreading or attempting to spread viruses,
                Trojans, worms, or any other devices that are designed or intended to disrupt, damage or
                interfere with any information, software, hardware or communication systems).
            </p>

            <br>
            <h4>Conduct of Use</h4>
            <br>
            <p>You are allowed to access the content of this website for your personal, non-commercial use,
                provided you do so without violation of copyright and other proprietary rights, and provided you
                do not use this website for any purpose that is unlawful or prohibited by these terms and
                conditions. You accept not to use this website in any way that is unlawful, abusive,
                threatening, harassing, obscene, libelous, hateful, or in any other way violating these terms
                and conditions. While using this website, you accept not to post any inaccurate or false
                information about yourself, or any information that is not a part of your own CV, or any
                unsolicited advertisements or business proposals, or chain letters and junk mail. As a user of
                this website and its service, you are responsible for your own communications and for the
                consequences of your posting.</p>

            <br>
            <h4>Liability of Fujtrade</h4>
            <br>
            <p>The content of this website may include inaccuracies or typographical errors. You use this
                website and its content at your own risk. Changes are periodically made to this website and its
                content and may be made at any time. Fujtrade has no obligation to monitor your use of
                this website or to retain the content of your session. Fujtrade does not control or
                guarantee the accuracy of information posted by users. Fujtrade may take action to prevent
                the use of this website that may create liability to Fujtrade.</p>

            <br>
            <h4>Disclaimer of Warranties and Consequential Damages</h4>
            <br>
            <p>Fujtrade does not represent or warrant that this website will operate uninterrupted or
                error-free, or that the website or the server that makes it available are free of computer
                viruses or other harmful devices. All content of this website is provided "as is" without any
                warranties of any kind, including warranty of merchantability, fitness for particular purpose
                and non-infringement. Fujtrade does not represent or warrant that this website, its
                content, its use or results of use be correct, accurate, timely, or otherwise reliable.
               Fujtrade will not be responsible or liable for the use of this website that is illegal or in
                any way violating these terms and conditions. Under no circumstances should Fujtrade be
                liable for any direct, indirect, or consequential damages resulting from your use or inability
                to use this website.</p>

            <br>
            <h4>Links to Other Sites</h4>
            <br>
            <p>This website contains links to third party websites. Fujtrade provides these links only as
                a convenience to you and not as an endorsement of the contents of these third-party websites,
                for which Fujtrade holds no responsibility. You access linked third-party websites at your
                own risk.</p>

            <br>
            <h4>Indemnity</h4>
            <br>
            <p>You agree to defend, indemnify, and hold harmless Fujtrade, its directors, employees,
                representatives and agents, from and against all liabilities, claims, actions, demands or
                expenses, including without limitation legal and accounting fees, alleging or resulting from
                your use or misuse of this website or your breach of these terms and conditions.</p>

            <br>
            <h4>Display Advertising</h4>
            <br>
            <p>Fujtrade has implemented Display Advertising and uses Doubleclick, a Google Analytics
                feature based on Display Advertising. You can opt-out of Google Analytics for Display
                Advertising and customize Google Display Network ads using the Ads Preferences Manager. You can
                also instruct the Google Analytics not to send any information about your website visits to
                Google Analytics by downloading and installing the Google Analytics Opt-out Browser Add-on for
                your current web browser.</p>

            <br>
            <h4>Contact Information</h4>
            <br>
            <p>contact@fjeducation.com</p>

            <br>
            <h4>Limitation of Warranties</h4>
            <br>
            <p>By using our website, you understand and agree that all Resources we provide are "as is" and "as
                available". This means that we do not represent or warrant to you that:
                i) the use of our Resources will meet your needs or requirements.
                ii) the use of our Resources will be uninterrupted, timely, secure or free from errors.
                iii) the information obtained by using our Resources will be accurate or reliable, and
                iv) any defects in the operation or functionality of any Resources we provide will be repaired
                or corrected.
                Furthermore, you understand and agree that:
                v) any content downloaded or otherwise obtained through the use of our Resources is done at your
                own discretion and risk, and that you are solely responsible for any damage to your computer or
                other devices for any loss of data that may result from the download of such content.
                vi) no information or advice, whether expressed, implied, oral or written, obtained by you from
                Fujtrade or through any Resources we provide shall create any warranty, guarantee, or
                conditions of any kind, except for those expressly outlined in this User Agreement.
            </p>

            <br>
            <h4>Limitation of Liability</h4>
            <br>
            <p>In conjunction with the Limitation of Warranties as explained above, you expressly understand and
                agree that any claim against us shall be limited to the amount you paid, if any, for use of
                products and/or services. Fujtrade will not be liable for any direct, indirect,
                incidental, consequential or exemplary loss or damages which may be incurred by you as a result
                of using our Resources, or as a result of any changes, data loss or corruption, cancellation,
                loss of access, or downtime to the full extent that applicable limitation of liability laws
                apply.</p>

            <br>
            <h4>Governing Law</h4>
            <br>
            <p>This website is controlled by Fujtrade from our offices located in  Creative City Tower, Dubai UAE. It can be accessed by most countries around the world. As each country has laws that may differ from those of UK, by accessing our website, you agree that the statutes and laws of United Kingdom, without regard to the conflict of laws and the United Nations Convention on the International Sales of Goods, will apply to all matters relating to the use of this website and the purchase of any products or services through this site.
                Furthermore, any action to enforce this User Agreement shall be brought in the courts located in United Kingdom, You hereby agree to personal jurisdiction by such courts, and waive any jurisdictional, venue, or inconvenient forum objections to such courts.

            </p>
            <br>
            These Terms and Conditions were last modified on February 2, 2024
        </div>
       </div>
    </div>
@endsection
