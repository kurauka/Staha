<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'includes/header.php';
require_once 'config/db.php';

$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
?>

<main class="max-w-7xl mx-auto px-6 md:px-12 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Profile -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-6 text-center">
                <div class="relative inline-block mb-4">
                    <img src="<?php echo $user['profile_img'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($user['name']) . '&size=128&background=random'; ?>"
                        alt="Profile" class="w-24 h-24 rounded-full border-4 border-sky-50 shadow-lg mx-auto">
                    <button
                        class="absolute bottom-0 right-0 bg-sky-500 text-white p-2 rounded-full shadow-md hover:bg-sky-600 transition">
                        <i class="fa-solid fa-camera text-xs"></i>
                    </button>
                </div>
                <h2 class="text-xl font-bold text-slate-900">
                    <?php echo htmlspecialchars($user['name']); ?>
                </h2>
                <p class="text-sm text-sky-600 font-medium mb-4">
                    <?php echo htmlspecialchars($user['rank'] ?? 'Maritime Professional'); ?>
                </p>
                <div class="border-t border-slate-50 pt-4 flex justify-around">
                    <div>
                        <span class="block text-xl font-bold text-slate-900">12</span>
                        <span class="text-xs text-slate-400 uppercase tracking-tighter">Posts</span>
                    </div>
                    <div>
                        <span class="block text-xl font-bold text-slate-900">45</span>
                        <span class="text-xs text-slate-400 uppercase tracking-tighter">Followers</span>
                    </div>
                </div>
                <a href="profile.php"
                    class="mt-6 block w-full bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold py-2 rounded-xl transition border border-slate-200 text-sm">
                    View Profile
                </a>
            </div>

            <div class="mt-6 bg-white rounded-3xl shadow-xl border border-slate-100 p-6">
                <h3 class="font-bold text-slate-900 mb-4">Quick Navigation</h3>
                <nav class="space-y-2">
                    <a href="dashboard.php"
                        class="flex items-center space-x-3 p-3 rounded-xl bg-sky-50 text-sky-600 font-bold transition">
                        <i class="fa-solid fa-house"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="jobs.php"
                        class="flex items-center space-x-3 p-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                        <i class="fa-solid fa-briefcase"></i>
                        <span>Job Board</span>
                    </a>
                    <a href="community.php"
                        class="flex items-center space-x-3 p-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                        <i class="fa-solid fa-users"></i>
                        <span>Community</span>
                    </a>
                    <a href="seatime.php"
                        class="flex items-center space-x-3 p-3 rounded-xl text-slate-600 hover:bg-slate-50 transition">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <span>SeaTime Tracker</span>
                    </a>
                    <a href="logout.php"
                        class="flex items-center space-x-3 p-3 rounded-xl text-red-500 hover:bg-red-50 transition mt-4">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Feed / Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Post Composer -->
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-6">
                <div class="flex space-x-4">
                    <img src="<?php echo $user['profile_img'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($user['name']) . '&background=random'; ?>"
                        alt="User" class="w-10 h-10 rounded-full">
                    <button
                        class="flex-1 text-left bg-slate-50 hover:bg-slate-100 px-6 py-2.5 rounded-full text-slate-400 text-sm transition border border-slate-100">
                        Share an update, certificate, or experience...
                    </button>
                </div>
            </div>

            <!-- Feed Placeholder -->
            <div class="space-y-6">
                <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center space-x-3">
                                <img src="https://ui-avatars.com/api/?name=Capt+Rodriguez&background=random"
                                    class="w-11 h-11 rounded-full">
                                <div>
                                    <h4 class="font-bold text-slate-900 text-sm">Capt. Marco Rodriguez</h4>
                                    <p class="text-xs text-slate-400">Master Mariner • 2h ago</p>
                                </div>
                            </div>
                            <button class="text-slate-400 hover:text-slate-600"><i
                                    class="fa-solid fa-ellipsis-v"></i></button>
                        </div>
                        <p class="text-slate-700 text-sm leading-relaxed mb-4">
                            Just safely docked in Singapore after a 22-day transit from Rotterdam. Proud of the engine
                            crew for keeping the plant running efficiently throughout the voyage. Fair winds to all
                            currently at sea! ⚓🚢
                        </p>
                        <img src="https://images.unsplash.com/photo-1544218809-514d88e0b490?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=60"
                            class="rounded-2xl w-full object-cover max-h-80 mb-4 shadow-sm">
                        <div class="flex items-center justify-between border-t border-slate-50 pt-4">
                            <div class="flex space-x-4">
                                <button
                                    class="flex items-center space-x-2 text-slate-500 hover:text-sky-500 transition text-sm">
                                    <i class="fa-regular fa-thumbs-up"></i>
                                    <span>24 Likes</span>
                                </button>
                                <button
                                    class="flex items-center space-x-2 text-slate-500 hover:text-sky-500 transition text-sm">
                                    <i class="fa-regular fa-comment"></i>
                                    <span>5 Comments</span>
                                </button>
                            </div>
                            <button class="text-slate-500 hover:text-sky-500 transition text-sm">
                                <i class="fa-regular fa-share-from-square"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar - Jobs / Suggestions -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-6">
                <h3 class="font-bold text-slate-900 mb-4 flex justify-between items-center">
                    Top Jobs
                    <a href="jobs.php" class="text-xs text-sky-600 hover:underline">View All</a>
                </h3>
                <div class="space-y-4">
                    <div class="group cursor-pointer">
                        <h4 class="text-sm font-bold text-slate-900 hover:text-sky-600 transition">Chief Engineer</h4>
                        <p class="text-xs text-slate-500">Maersk Line • Oil Tanker</p>
                    </div>
                    <div class="group cursor-pointer">
                        <h4 class="text-sm font-bold text-slate-900 hover:text-sky-600 transition">2nd Officer</h4>
                        <p class="text-xs text-slate-500">MSC Cruises • Cruise Ship</p>
                    </div>
                    <div class="group cursor-pointer">
                        <h4 class="text-sm font-bold text-slate-900 hover:text-sky-600 transition">Deck Cadet</h4>
                        <p class="text-xs text-slate-500">CMA CGM • Container</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-sky-500 to-indigo-600 rounded-3xl shadow-xl p-6 text-white text-center">
                <i class="fa-solid fa-award text-4xl mb-4 opacity-50"></i>
                <h3 class="font-bold mb-2">Upgrade to Pro</h3>
                <p class="text-xs text-sky-100 mb-6 leading-relaxed">Get noticed by top recruiters and unlock premium
                    job analytics.</p>
                <button
                    class="w-full bg-white text-sky-600 font-bold py-2.5 rounded-xl text-sm hover:bg-sky-50 transition shadow-lg">Upgrade
                    Now</button>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>