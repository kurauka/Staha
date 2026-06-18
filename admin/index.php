<?php
session_start();
// Basic Admin Auth Check (role should be 'admin')
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

require_once '../config/db.php';
include '../includes/header.php'; // We might need a slightly different header for admin, but let's reuse for now

// Stats
$userCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$jobCount = $pdo->query("SELECT COUNT(*) FROM jobs")->fetchColumn();
$unverifiedCerts = $pdo->query("SELECT COUNT(*) FROM certificates WHERE verified = 0")->fetchColumn();
?>

<main class="max-w-7xl mx-auto px-6 md:px-12 py-10">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10">
        <div>
            <h1 class="text-4xl font-bold text-slate-900 mb-2 font-['Outfit']">Admin Dashboard</h1>
            <p class="text-slate-500">Overview of the Staha network performance.</p>
        </div>
        <div class="flex space-x-3">
            <a href="users.php"
                class="bg-white border border-slate-200 text-slate-700 px-6 py-3 rounded-2xl font-bold hover:bg-slate-50 transition">Manage
                Users</a>
            <a href="#"
                class="bg-sky-600 text-white px-6 py-3 rounded-2xl font-bold hover:bg-sky-700 transition shadow-lg shadow-sky-600/20">System
                Settings</a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-slate-50">
            <div class="w-12 h-12 bg-sky-50 rounded-2xl flex items-center justify-center text-sky-600 mb-4">
                <i class="fa-solid fa-users"></i>
            </div>
            <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Total Seafarers</h3>
            <p class="text-3xl font-black text-slate-900">
                <?php echo $userCount; ?>
            </p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-slate-50">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-4">
                <i class="fa-solid fa-briefcase"></i>
            </div>
            <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Active Job Postings</h3>
            <p class="text-3xl font-black text-slate-900">
                <?php echo $jobCount; ?>
            </p>
        </div>

        <div class="bg-white p-8 rounded-[2rem] shadow-xl border border-slate-50">
            <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mb-4">
                <i class="fa-solid fa-certificate"></i>
            </div>
            <h3 class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1">Pending Verifications</h3>
            <p class="text-3xl font-black text-slate-900">
                <?php echo $unverifiedCerts; ?>
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Users -->
        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-50 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-900">Recently Joined</h3>
                <a href="users.php" class="text-sky-600 text-sm font-bold hover:underline">View All</a>
            </div>
            <div class="p-8">
                <div class="space-y-6">
                    <?php
                    $recentUsers = $pdo->query("SELECT * FROM users ORDER BY created_at DESC LIMIT 5")->fetchAll();
                    foreach ($recentUsers as $u):
                        ?>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($u['name']); ?>&background=random"
                                    class="w-10 h-10 rounded-xl">
                                <div>
                                    <h4 class="text-sm font-bold text-slate-800">
                                        <?php echo htmlspecialchars($u['name']); ?>
                                    </h4>
                                    <p class="text-[10px] text-slate-400">
                                        <?php echo htmlspecialchars($u['role']); ?> •
                                        <?php echo date('M d', strtotime($u['created_at'])); ?>
                                    </p>
                                </div>
                            </div>
                            <button class="text-slate-300 hover:text-sky-600 transition"><i
                                    class="fa-solid fa-eye text-sm"></i></button>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Recent Jobs -->
        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-50 overflow-hidden">
            <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-900">Latest Jobs</h3>
                <a href="../jobs.php" class="text-sky-600 text-sm font-bold hover:underline">View All</a>
            </div>
            <div class="p-8">
                <div class="space-y-6">
                    <?php
                    $latestJobs = $pdo->query("SELECT * FROM jobs ORDER BY created_at DESC LIMIT 5")->fetchAll();
                    foreach ($latestJobs as $j):
                        ?>
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">
                                    <?php echo htmlspecialchars($j['title']); ?>
                                </h4>
                                <p class="text-[10px] text-slate-400">
                                    <?php echo htmlspecialchars($j['company']); ?> •
                                    <?php echo htmlspecialchars($j['source']); ?>
                                </p>
                            </div>
                            <span class="text-[10px] bg-slate-50 px-2 py-1 rounded text-slate-500">
                                <?php echo date('M d', strtotime($j['created_at'])); ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include '../includes/footer.php'; ?>