<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'includes/header.php';
require_once 'config/db.php';

$userId = $_SESSION['user_id'];

// Fetch posts
$stmt = $pdo->query("SELECT p.*, u.name as user_name, u.rank as user_rank, u.profile_img 
                     FROM posts p 
                     JOIN users u ON p.user_id = u.id 
                     ORDER BY p.created_at DESC");
$posts = $stmt->fetchAll();
?>

<main class="max-w-7xl mx-auto px-6 md:px-12 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-6">
                <h3 class="font-bold text-slate-900 mb-4">Trending Topics</h3>
                <div class="space-y-4">
                    <a href="#"
                        class="block text-sm font-medium text-slate-500 hover:text-sky-600 transition">#STCW2024</a>
                    <a href="#"
                        class="block text-sm font-medium text-slate-500 hover:text-sky-600 transition">#OceanSafety</a>
                    <a href="#"
                        class="block text-sm font-medium text-slate-500 hover:text-sky-600 transition">#MaritimeJobs</a>
                    <a href="#"
                        class="block text-sm font-medium text-slate-500 hover:text-sky-600 transition">#VesselTech</a>
                </div>
            </div>
        </div>

        <!-- Feed -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Composer -->
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-6">
                <form action="save_post.php" method="POST" enctype="multipart/form-data">
                    <div class="flex space-x-4 mb-4">
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name']); ?>&background=random"
                            class="w-10 h-10 rounded-full">
                        <textarea name="content" required placeholder="What's happening on your vessel?"
                            class="flex-1 bg-slate-50 border border-slate-100 rounded-2xl p-4 text-sm focus:ring-2 focus:ring-sky-100 outline-none resize-none h-24"></textarea>
                    </div>
                    <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                        <button type="button" class="text-slate-400 hover:text-sky-600 transition">
                            <i class="fa-solid fa-image text-xl"></i>
                        </button>
                        <button
                            class="bg-sky-600 hover:bg-sky-700 text-white font-bold px-6 py-2 rounded-xl transition shadow-lg shadow-sky-600/20 text-sm">
                            Post Update
                        </button>
                    </div>
                </form>
            </div>

            <!-- Posts -->
            <?php if (empty($posts)): ?>
                <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-12 text-center text-slate-400">
                    <i class="fa-solid fa-comments text-4xl mb-4 opacity-20"></i>
                    <p>No posts yet. Be the first to start a discussion!</p>
                </div>
            <?php else: ?>
                <?php foreach ($posts as $post): ?>
                    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center space-x-3">
                                    <img src="<?php echo $post['profile_img'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($post['user_name']) . '&background=random'; ?>"
                                        class="w-11 h-11 rounded-full">
                                    <div>
                                        <h4 class="font-bold text-slate-900 text-sm">
                                            <?php echo htmlspecialchars($post['user_name']); ?>
                                        </h4>
                                        <p class="text-xs text-slate-400">
                                            <?php echo htmlspecialchars($post['user_rank']); ?> •
                                            <?php echo date('M d, H:i', strtotime($post['created_at'])); ?>
                                        </p>
                                    </div>
                                </div>
                                <button class="text-slate-400 hover:text-slate-600"><i
                                        class="fa-solid fa-ellipsis-v"></i></button>
                            </div>
                            <p class="text-slate-700 text-sm leading-relaxed mb-4">
                                <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                            </p>
                            <?php if ($post['image']): ?>
                                <img src="<?php echo $post['image']; ?>"
                                    class="rounded-2xl w-full object-cover max-h-80 mb-4 shadow-sm">
                            <?php endif; ?>
                            <div class="flex items-center justify-between border-t border-slate-50 pt-4">
                                <div class="flex space-x-4">
                                    <button
                                        class="flex items-center space-x-2 text-slate-500 hover:text-sky-500 transition text-sm">
                                        <i class="fa-regular fa-thumbs-up"></i>
                                        <span>Like</span>
                                    </button>
                                    <button
                                        class="flex items-center space-x-2 text-slate-500 hover:text-sky-500 transition text-sm">
                                        <i class="fa-regular fa-comment"></i>
                                        <span>Comment</span>
                                    </button>
                                </div>
                                <button class="text-slate-500 hover:text-sky-500 transition text-sm">
                                    <i class="fa-regular fa-share-from-square"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Right Side -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-6">
                <h3 class="font-bold text-slate-900 mb-4">Who to Follow</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name=Capt+Ibrahim&background=random"
                                class="w-8 h-8 rounded-full">
                            <span class="text-xs font-bold text-slate-700">Capt. Ibrahim</span>
                        </div>
                        <button
                            class="text-sky-600 text-[10px] font-bold uppercase tracking-widest hover:underline">Follow</button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name=Maritime+Acad&background=random"
                                class="w-8 h-8 rounded-full">
                            <span class="text-xs font-bold text-slate-700">Maritime Academy</span>
                        </div>
                        <button
                            class="text-sky-600 text-[10px] font-bold uppercase tracking-widest hover:underline">Follow</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>