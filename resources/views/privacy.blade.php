@extends('layouts.app')

@section('content')
    @include('includes.header')
    
    <section class="container-spacing">
        <div class="container-width max-w-screen-2xl mx-auto">
            <x-guest-header icon="fa-shield-halved" text="Privacy Notice" />

            <header class="font-bold my-[100px] text-center">
                <h3>Alumni Tracer Directory and Decision Support System (ATD-DSS)</h3>
                <p><em>Cagayan State University of Aparri</em></p>
                <p>Last Updated: <em>November 20, 2025</em></p>
            </header>

            <article class="prose lg:prose-xl">
                <section>
                    <h2 class="font-bold text-lg uppercase">01. Introduction</h2>

                    <p class="mt-3">
                        Cagayan State University of Aparri is committed to protecting the privacy and personal data of our alumni. 
                        This Privacy Notice explains how we collect, use, store, disclose, and safeguard personal information processed 
                        through the Alumni Tracer Directory and Decision Support System (ATD-DSS).
                    </p>
                    
                    <p class="mt-3">
                        The system is designed to maintain 
                        alumni records, track employability, support institutional planning, and strengthen alumni engagement. We comply 
                        with applicable data protection laws such as the Data Privacy Act of 2012 or relevant national laws.
                    </p>
                </section>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <section>
                    <h2 class="font-bold text-lg uppercase">02. Scope and Application</h2>

                    <p class="mt-3">
                        This Privacy Notice applies to all alumni who register or update profiles, users accessing the ATD-DSS, and 
                        authorized staff handling data. It does not apply to third-party websites linked from the platform.
                    </p>
                </section>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <h2 class="font-bold text-lg uppercase">03. Information We Collect</h2>

                <section class="mt-5">
                    <h3 class="font-bold">3.1 Personal Identification Information</h3>
                    <p>Full name, date of birth, sex/gender, contact details, current address.</p>
                </section>

                <section class="mt-5">
                    <h3 class="font-bold">3.2 Academic Information</h3>
                    <p>Degree program, year graduated, campus/department affiliation.</p>
                </section>

                <section class="mt-5">
                    <h3 class="font-bold">3.3 Employment and Professional Information</h3>
                    <p>Employment status, employer details, job title, industry.</p>
                </section>

                <section class="mt-5">
                    <h3 class="font-bold">3.4 System and Technical Data</h3>
                    <p>Login credentials, IP address, browser/device info, cookies, system logs.</p>
                </section>

                <section class="mt-5">
                    <h3 class="font-bold">3.5 Optional Information</h3>
                    <p>Event participation, networking details, feedback.</p>
                </section>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <section>
                    <h2 class="font-bold text-lg uppercase">04. How We Collect Information</h2>

                    <p class="mt-3">
                        Information is collected through online forms, tracer surveys, institutional database integration, manual updates, 
                        cookies, and analytics tools.
                    </p>
                </section>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <section>
                    <h2 class="font-bold text-lg uppercase">05. Legal Basis for Processing</h2>

                    <p class="mt-3">
                        We process your data based on your consent, legitimate institutional interest, legal compliance, and the performance 
                        of institutional mandates.
                    </p>
                </section>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <h2 class="font-bold text-lg uppercase">06. How We Use Your Information</h2>

                <section class="mt-5">
                    <h3 class="font-bold">6.1 Alumni Tracing and Engagement</h3>
                    <p>Maintaining directories, conducting surveys, sending announcements.</p>
                </section>

                <section class="mt-5">
                    <h3 class="font-bold">6.2 Institutional Planning and Decision Support</h3>
                    <p>Analytics for accreditation, curriculum enhancement, and strategic planning.</p>
                </section>

                <section class="mt-5">
                    <h3 class="font-bold">6.3 Career and Linkages Development</h3>
                    <p>Industry partnerships, job placement programs, skills mapping.</p>
                </section>

                <section class="mt-5">
                    <h3 class="font-bold">6.4 System Operations and Security</h3>
                    <p>User authentication, system monitoring, threat mitigation.</p>
                </section>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <h2 class="font-bold text-lg uppercase">07. Data Sharing and Disclosure</h2>

                <p class="mt-3">
                    We do not sell or rent your information. Data may be shared with authorized departments, government agencies, 
                    accrediting bodies, research units, and industry partners (with consent). All third parties are bound by 
                    confidentiality agreements.
                </p>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <h2 class="font-bold text-lg uppercase">8. Data Storage and Retention</h2>

                <p class="mt-3">
                    Your data is stored securely and retained for 5–10 years or as long as necessary for institutional or legal 
                    requirements. Afterward, data is securely anonymized or deleted.
                </p>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <h2 class="font-bold text-lg uppercase">09. Data Security Measures</h2>

                <p class="mt-3">
                    We implement role-based access, encryption, firewalls, backups, and staff training to ensure system and data 
                    protection. However, no system can guarantee absolute security; users also hold responsibility for securing 
                    their accounts.
                </p>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <h2 class="font-bold text-lg uppercase">10. Your Rights as a Data Subject</h2>

                <p class="mt-3">
                    You have the right to be informed, access, correct, withdraw consent, object, and file complaints regarding 
                    your personal information. Contact details are provided below to exercise these rights.
                </p>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <h2 class="font-bold text-lg uppercase">11. Cookies and Tracking Technologies</h2>

                <p class="mt-3">
                    The ATD-DSS uses cookies to enhance user experience, maintain sessions, and analyze usage. You may disable cookies 
                    in your browser, but some features may be affected.
                </p>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <h2 class="font-bold text-lg uppercase">12. Third-Party Links</h2>

                <p class="mt-3">
                    The platform may include links to external sites. We are not responsible for third-party content or privacy  practices.
                </p>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <h2 class="font-bold text-lg uppercase">13. Updates to This Privacy Notice</h2>

                <p class="mt-3">This Privacy Notice may be updated periodically. Changes will be posted with an updated date at the top of the page.</p>
            </article>

            <x-horizontal-rule />

            <article class="prose lg:prose-xl">
                <h2 class="font-bold text-lg uppercase">14. Contact Information</h2>

                <p class="mt-3">For data privacy inquiries or requests, contact: <x-anchor href="{{ route('home') }}#contact" text="Contact Us" /></p>
            </article>
        </div>
    </section>

    @include('includes.facebook')
    @include('includes.footer')
@endsection