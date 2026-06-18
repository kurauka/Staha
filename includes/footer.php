<?php
$current_page = basename($_SERVER['PHP_SELF']);
$auth_pages = ['login.php', 'register.php'];
if (!in_array($current_page, $auth_pages)):
    ?>
    <footer class="bg-slate-900 text-slate-300 py-12 px-6 md:px-12 mt-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <i class="fa-solid fa-anchor text-2xl text-sky-400"></i>
                    <span class="text-xl font-bold brand text-white">Staha</span>
                </div>
                <p class="text-sm leading-relaxed">
                    The leading professional network dedicated to maritime professionals, connecting seafarers, cadets, and
                    employers worldwide.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-sky-400 transition"><i class="fa-brands fa-linkedin-in text-xl"></i></a>
                    <a href="#" class="hover:text-sky-400 transition"><i class="fa-brands fa-twitter text-xl"></i></a>
                    <a href="#" class="hover:text-sky-400 transition"><i class="fa-brands fa-facebook-f text-xl"></i></a>
                </div>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="jobs.php" class="hover:text-sky-400 transition">Job Search</a></li>
                    <li><a href="register.php" class="hover:text-sky-400 transition">Post a Job</a></li>
                    <li><a href="community.php" class="hover:text-sky-400 transition">Community Feed</a></li>
                    <li><a href="#" class="hover:text-sky-400 transition">Career Tracker</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Resources</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="hover:text-sky-400 transition">STCW Requirements</a></li>
                    <li><a href="#" class="hover:text-sky-400 transition">Maritime News</a></li>
                    <li><a href="#" class="hover:text-sky-400 transition">Training Berths</a></li>
                    <li><a href="#" class="hover:text-sky-400 transition">FAQ</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-white font-semibold mb-4">Newsletter</h4>
                <p class="text-sm mb-4">Get the latest maritime job updates delivered to your inbox.</p>
                <form class="flex">
                    <input type="email" placeholder="Your email"
                        class="bg-slate-800 border-none rounded-l-lg px-4 py-2 w-full focus:ring-1 focus:ring-sky-400 text-white text-sm">
                    <button class="bg-sky-500 hover:bg-sky-600 text-white rounded-r-lg px-4 py-2 transition"><i
                            class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
        <div class="border-t border-slate-800 mt-12 pt-8 text-center text-xs text-slate-500">
            &copy;
            <?php echo date('Y'); ?> Staha Maritime Career Network. All rights reserved.
        </div>
    </footer>
<?php endif; ?>
</body>

</html>