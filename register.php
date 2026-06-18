<?php include 'includes/header.php'; ?>

<section class="min-h-[80vh] flex items-center justify-center py-12 px-6">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100">
        <div class="p-8 md:p-10">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Create Account</h2>
                <p class="text-slate-500">Join the maritime professional network</p>
            </div>

            <form action="register_process.php" method="POST" class="space-y-6">
                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 ml-1">Full Name</label>
                    <input type="text" name="name" required placeholder="John Doe"
                        class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 ml-1">Email Address</label>
                    <input type="email" name="email" required placeholder="john@example.com"
                        class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 ml-1">Account Type</label>
                        <select name="role" required
                            class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition appearance-none">
                            <option value="seafarer">Seafarer / Cadet</option>
                            <option value="recruiter">Recruiter</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700 ml-1">Rank (Optional)</label>
                        <input type="text" name="rank" placeholder="e.g. 2nd Officer"
                            class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700 ml-1">Password</label>
                    <input type="password" name="password" required placeholder="••••••••"
                        class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 focus:ring-2 focus:ring-sky-200 outline-none transition">
                </div>

                <button type="submit"
                    class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-4 rounded-xl transition shadow-lg shadow-sky-600/20">
                    Sign Up
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-slate-600 text-sm">Already have an account? <a href="login.php"
                        class="text-sky-600 font-bold hover:underline">Log in</a></p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>