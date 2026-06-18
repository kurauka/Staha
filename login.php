<?php include 'includes/header.php'; ?>

<section class="min-h-[80vh] flex items-center justify-center py-12 px-6">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
        <div class="p-8 md:p-10">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Welcome Back</h2>
                <p class="text-slate-500">Log in to your Staha account</p>
            </div>

            <?php if (isset($_GET['registered'])): ?>
                <div
                    class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mb-6 text-sm font-medium border border-emerald-100">
                    Registration successful! You can now log in.
                </div>
            <?php endif; ?>

            <form action="login_process.php" method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 ml-1">Email Address</label>
                    <input type="email" name="email" required placeholder="john@example.com"
                        class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition">
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center ml-1">
                        <label class="text-sm font-semibold text-slate-700">Password</label>
                        <a href="#" class="text-xs text-sky-600 hover:underline">Forgot?</a>
                    </div>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition">
                </div>

                <button type="submit"
                    class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-sky-600/20">
                    Log In
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-slate-600 text-sm">Don't have an account? <a href="register.php"
                        class="text-sky-600 font-bold hover:underline">Join Staha</a></p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>