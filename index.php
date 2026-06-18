<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section id="hero" class="relative overflow-hidden pt-16 pb-24 md:pt-32 md:pb-40">
    <!-- Animated Gradients Background -->
    <div class="absolute inset-0 -z-10 bg-slate-50">
        <div
            class="absolute top-0 -right-1/4 w-[600px] h-[600px] bg-sky-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-pulse">
        </div>
        <div
            class="absolute bottom-0 -left-1/4 w-[600px] h-[600px] bg-indigo-200/40 rounded-full mix-blend-multiply filter blur-3xl opacity-60 animate-pulse delay-700">
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
        <div class="space-y-8 z-10" data-aos="fade-right">
            <span
                class="inline-flex items-center space-x-2 bg-sky-100 text-sky-600 font-bold px-4 py-2 rounded-full text-xs uppercase tracking-widest shadow-sm">
                <i class="fa-solid fa-compass animate-spin-slow"></i>
                <span>Charting the Digital Sea</span>
            </span>
            <h1 class="text-6xl md:text-7xl font-extrabold text-slate-900 leading-[1.1] tracking-tight">
                Empowering the <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-sky-600 to-indigo-600">Global
                    Seafarer.</span>
            </h1>
            <p class="text-xl text-slate-600 max-w-lg leading-relaxed font-medium">
                Staha is the all-in-one professional hub for maritime excellence. Track seatime, find global
                opportunities, and build your legacy.
            </p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 pt-4">
                <a href="register.php"
                    class="bg-sky-600 hover:bg-sky-700 text-white text-center font-bold px-10 py-5 rounded-2xl transition-all hover:scale-105 active:scale-95 shadow-2xl shadow-sky-600/30 text-lg">
                    Start Your Voyage
                </a>
                <a href="jobs.php"
                    class="bg-white hover:bg-slate-50 text-slate-900 text-center font-bold px-10 py-5 rounded-2xl border-2 border-slate-100 transition-all hover:border-sky-300 text-lg">
                    Browse Jobs
                </a>
            </div>
            <div class="flex items-center space-x-6 pt-6 text-slate-500 border-t border-slate-100">
                <div class="flex -space-x-4">
                    <img src="https://ui-avatars.com/api/?name=Capt+John&background=38bdf8&color=fff"
                        class="w-12 h-12 rounded-full border-4 border-white shadow-sm" alt="Officer">
                    <img src="https://ui-avatars.com/api/?name=Sara+M&background=6366f1&color=fff"
                        class="w-12 h-12 rounded-full border-4 border-white shadow-sm" alt="Cadet">
                    <img src="https://ui-avatars.com/api/?name=Eng+Tom&background=10b981&color=fff"
                        class="w-12 h-12 rounded-full border-4 border-white shadow-sm" alt="Engineer">
                </div>
                <p class="text-sm font-medium"><span class="text-slate-900 font-bold block text-lg">12,500+</span>
                    Professionals onboard</p>
            </div>
        </div>

        <div class="relative lg:block" data-aos="zoom-in">
            <div
                class="relative z-10 p-4 bg-white/30 backdrop-blur-sm rounded-[2.5rem] border border-white/40 shadow-2xl overflow-hidden group">
                <img src="assets/images/hero_ship.png" alt="Maritime Vessel"
                    class="rounded-[2rem] shadow-lg transition-transform duration-700 group-hover:scale-105">
                <!-- Floating Info Cards -->
                <div
                    class="absolute top-8 right-8 bg-white/90 backdrop-blur p-4 rounded-2xl shadow-xl border border-white max-w-[180px] hidden md:block animate-float">
                    <div class="flex items-center space-x-3 mb-2">
                        <div
                            class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-600">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <span class="text-xs font-bold text-slate-800">Verified Skills</span>
                    </div>
                    <p class="text-[10px] text-slate-500">Over 8k certifications verified this month.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Bar -->
<section id="stats" class="py-12 bg-slate-900 overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-6 md:px-12 grid grid-cols-2 lg:grid-cols-4 gap-8 text-center relative z-10">
        <div class="space-y-2">
            <h3 class="text-4xl font-bold text-white tracking-widest">15,000+</h3>
            <p class="text-slate-400 text-sm uppercase font-bold tracking-widest">Registered Members</p>
        </div>
        <div class="space-y-2">
            <h3 class="text-4xl font-bold text-sky-400 tracking-widest">850+</h3>
            <p class="text-slate-400 text-sm uppercase font-bold tracking-widest">Active Vessel Jobs</p>
        </div>
        <div class="space-y-2">
            <h3 class="text-4xl font-bold text-white tracking-widest">240k+</h3>
            <p class="text-slate-400 text-sm uppercase font-bold tracking-widest">SeaTime Days Tracked</p>
        </div>
        <div class="space-y-2">
            <h3 class="text-4xl font-bold text-sky-400 tracking-widest">98%</h3>
            <p class="text-slate-400 text-sm uppercase font-bold tracking-widest">Placement Success</p>
        </div>
    </div>
</section>

<!-- Mission Section -->
<section id="about" class="py-32 bg-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-12 flex flex-col lg:flex-row items-center gap-20">
        <div class="lg:w-1/2 space-y-8">
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
                Designed for the <br>
                <span class="bg-sky-100 px-3 rounded-lg text-sky-700 italic">Modern Voyager</span>
            </h2>
            <p class="text-lg text-slate-600 leading-relaxed">
                Staha was born out of a simple necessity: the need for a digital compass in the complex maritime world.
                We've built more than a job board; we've built a ecosystem that understands your rank, your sea-time,
                and your career goals.
            </p>
            <ul class="space-y-4">
                <li class="flex items-start space-x-4">
                    <div
                        class="mt-1 w-6 h-6 bg-sky-600 rounded-full flex items-center justify-center text-white text-[10px]">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900">Carrier Transparency</h4>
                        <p class="text-sm text-slate-500">Real-time tracking of license requirements and upgrades.</p>
                    </div>
                </li>
                <li class="flex items-start space-x-4">
                    <div
                        class="mt-1 w-6 h-6 bg-sky-600 rounded-full flex items-center justify-center text-white text-[10px]">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900">Verified Global Network</h4>
                        <p class="text-sm text-slate-500">Connect only with verified shipowners and recruiters.</p>
                    </div>
                </li>
            </ul>
        </div>
        <div class="lg:w-1/2">
            <div class="relative group">
                <div
                    class="absolute -inset-4 bg-gradient-to-r from-sky-500 to-indigo-500 rounded-[3rem] opacity-20 blur-2xl group-hover:opacity-40 transition duration-500">
                </div>
                <img src="assets/images/community_officers.png" alt="Maritime Community"
                    class="relative rounded-[2.5rem] shadow-2xl border-4 border-white transition-transform duration-500 group-hover:scale-[1.02]">
            </div>
        </div>
    </div>
</section>

<!-- Advanced Showcase -->
<section id="analytics" class="py-32 bg-slate-50 skew-y-1">
    <div class="max-w-7xl mx-auto px-6 md:px-12 -skew-y-1 flex flex-col lg:flex-row-reverse items-center gap-20">
        <div class="lg:w-1/2 space-y-8 text-right lg:text-left">
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
                Navigate with <br>
                <span class="text-sky-600 underline decoration-indigo-200 underline-offset-8">Precision
                    Intelligence.</span>
            </h2>
            <p class="text-lg text-slate-600 leading-relaxed">
                Our advanced SeaTime analytics engine processes your voyage data to provide actionable insights. Know
                exactly when you're eligible for your next rank, and which licenses need attention.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-left">
                    <i class="fa-solid fa-chart-line text-sky-500 text-2xl mb-4"></i>
                    <h5 class="font-bold mb-1">Rank Progress</h5>
                    <p class="text-xs text-slate-400">Visual indicators for rank advancements.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 text-left">
                    <i class="fa-solid fa-bell text-indigo-500 text-2xl mb-4"></i>
                    <h5 class="font-bold mb-1">Expiry Alerts</h5>
                    <p class="text-xs text-slate-400">Automatic reminders for cert renewals.</p>
                </div>
            </div>
        </div>
        <div class="lg:w-1/2">
            <img src="assets/images/dashboard_analytics.png" alt="Advanced Dashboard"
                class="w-full drop-shadow-[0_35px_35px_rgba(0,0,0,0.15)] animate-float-slow">
        </div>
    </div>
</section>

<!-- Features Grid -->
<section id="features" class="py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <div class="text-center mb-24">
            <span class="text-sky-600 font-bold bg-sky-50 px-4 py-2 rounded-full text-xs uppercase tracking-widest">The
                Toolkit</span>
            <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 mt-6 mb-4">Everything You Need To Sail High
            </h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg leading-relaxed">Integrated tools designed by maritime
                experts for maritime professionals.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <!-- Job Hub -->
            <div
                class="group p-10 rounded-[2.5rem] bg-white border border-slate-100 hover:border-sky-200 hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-sky-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700">
                </div>
                <div
                    class="w-16 h-16 bg-sky-100 rounded-3xl flex items-center justify-center text-sky-600 mb-8 relative z-10 group-hover:bg-sky-600 group-hover:text-white transition duration-500">
                    <i class="fa-solid fa-compass-drafting text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4 relative z-10">Job Hub</h3>
                <p class="text-slate-500 leading-relaxed relative z-10">Access a curated feed of maritime roles from
                    global shipping giants, tailored to your rank and experience.</p>
            </div>

            <!-- SeaTime Plus -->
            <div
                class="group p-10 rounded-[2.5rem] bg-white border border-slate-100 hover:border-indigo-200 hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700">
                </div>
                <div
                    class="w-16 h-16 bg-indigo-100 rounded-3xl flex items-center justify-center text-indigo-600 mb-8 relative z-10 group-hover:bg-indigo-600 group-hover:text-white transition duration-500">
                    <i class="fa-solid fa-shield-halved text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4 relative z-10">SeaTime Plus</h3>
                <p class="text-slate-500 leading-relaxed relative z-10">Automated tracking of your voyage days with
                    digital logbook verification for fast-track career pathing.</p>
            </div>

            <!-- Crew Connect -->
            <div
                class="group p-10 rounded-[2.5rem] bg-white border border-slate-100 hover:border-emerald-200 hover:shadow-2xl transition-all duration-500 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700">
                </div>
                <div
                    class="w-16 h-16 bg-emerald-100 rounded-3xl flex items-center justify-center text-emerald-600 mb-8 relative z-10 group-hover:bg-emerald-600 group-hover:text-white transition duration-500">
                    <i class="fa-solid fa-satellite-dish text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 mb-4 relative z-10">Crew Connect</h3>
                <p class="text-slate-500 leading-relaxed relative z-10">Join the professional social network where you
                    can find mentors, former crewmates, and industry experts.</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section id="newsletter" class="py-24 bg-slate-900 relative overflow-hidden">
    <div class="absolute top-0 left-0 w-full h-full opacity-20">
        <div class="absolute top-10 left-10 w-64 h-64 bg-sky-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-64 h-64 bg-indigo-500 rounded-full blur-3xl"></div>
    </div>

    <div class="max-w-5xl mx-auto px-6 md:px-12 relative z-10">
        <div
            class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-[3rem] p-12 md:p-20 text-center space-y-8">
            <div
                class="inline-flex items-center space-x-2 bg-indigo-500/20 text-indigo-300 font-bold px-4 py-2 rounded-full text-xs uppercase tracking-widest">
                <i class="fa-solid fa-envelope-open-text"></i>
                <span>Weekly Dispatch</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-extrabold text-white leading-tight">
                Get the Latest Jobs <br>
                <span class="text-sky-400">Straight to Your Inbox.</span>
            </h2>
            <p class="text-slate-400 text-lg max-w-2xl mx-auto">
                Join 5,000+ seafarers who receive our weekly digest of verified maritime opportunities and industry
                insights.
            </p>

            <form id="subscribeForm" class="flex flex-col md:flex-row gap-4 max-w-2xl mx-auto pt-4">
                <input type="email" name="email" required placeholder="Enter your email address"
                    class="flex-1 bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-sky-500 transition">
                <button type="submit"
                    class="bg-sky-600 hover:bg-sky-700 text-white font-bold px-10 py-4 rounded-2xl transition shadow-lg shadow-sky-600/20 whitespace-nowrap">
                    Subscribe Now
                </button>
            </form>
            <div id="subscribeMessage" class="hidden text-sm font-medium"></div>
        </div>
    </div>
</section>

<script>
    document.getElementById('subscribeForm').addEventListener('submit', async function (e) {
        e.preventDefault();
        const form = this;
        const email = form.email.value;
        const msg = document.getElementById('subscribeMessage');
        const btn = form.querySelector('button');

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Subscribing...';

        try {
            const formData = new FormData();
            formData.append('email', email);

            const response = await fetch('api/newsletter_subscribe.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            msg.classList.remove('hidden', 'text-emerald-400', 'text-rose-400');
            if (data.status === 'success') {
                msg.textContent = data.message;
                msg.classList.add('text-emerald-400');
                form.reset();
            } else {
                msg.textContent = data.message;
                msg.classList.add('text-rose-400');
            }
        } catch (error) {
            msg.textContent = 'Something went wrong. Please try again.';
            msg.classList.add('text-rose-400');
        } finally {
            btn.disabled = false;
            btn.textContent = 'Subscribe Now';
        }
    });
</script>

<!-- Final CTA -->
<section class="py-24 bg-sky-600 relative overflow-hidden mx-6 md:mx-12 rounded-[3.5rem] my-24">
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
    <div class="max-w-4xl mx-auto text-center relative z-10 space-y-10">
        <h2 class="text-5xl md:text-6xl font-extrabold text-white leading-tight">Ready to Navigate Your <br>
            Professional Future?</h2>
        <p class="text-sky-100 text-xl font-medium max-w-2xl mx-auto">Join thousands of officers and crew members who
            are taking control of their maritime careers today.</p>
        <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-6">
            <a href="register.php"
                class="bg-white text-sky-600 hover:bg-slate-50 px-12 py-5 rounded-2xl font-extrabold text-xl transition-all shadow-xl hover:scale-105 active:scale-95">
                Join the Fleet
            </a>
            <a href="jobs.php"
                class="bg-sky-700 text-white hover:bg-sky-800 px-12 py-5 rounded-2xl font-extrabold text-xl transition-all border border-sky-400/30">
                Explore Jobs
            </a>
        </div>
    </div>
</section>

<style>
    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }

    @keyframes float-slow {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-40px);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-float-slow {
        animation: float-slow 10s ease-in-out infinite;
    }

    .animate-spin-slow {
        animation: spin 12s linear infinite;
    }
</style>


<?php include 'includes/footer.php'; ?>