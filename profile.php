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

// Fetch certs
$stmt = $pdo->prepare("SELECT * FROM certificates WHERE user_id = ?");
$stmt->execute([$userId]);
$certs = $stmt->fetchAll();
?>

<main class="max-w-7xl mx-auto px-6 md:px-12 py-10">
    <div class="bg-white rounded-[40px] shadow-2xl border border-slate-100 overflow-hidden mb-12">
        <div class="h-48 bg-gradient-to-r from-sky-400 to-indigo-600 relative">
            <div class="absolute -bottom-16 left-12">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['name']); ?>&size=160&background=random"
                    class="w-32 h-32 rounded-[2rem] border-8 border-white shadow-xl">
            </div>
        </div>
        <div class="pt-20 pb-12 px-12 flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div>
                <h1 class="text-4xl font-bold text-slate-900">
                    <?php echo htmlspecialchars($user['name']); ?>
                </h1>
                <p class="text-lg text-sky-600 font-medium">
                    <?php echo htmlspecialchars($user['rank'] ?? 'Maritime Professional'); ?>
                </p>
                <div class="flex items-center space-x-4 mt-2 text-slate-400 text-sm">
                    <span><i class="fa-solid fa-location-dot mr-1"></i> Global Waters</span>
                    <span><i class="fa-solid fa-calendar mr-1"></i> Joined Feb 2026</span>
                </div>
            </div>
            <div class="flex space-x-3">
                <button
                    class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3 rounded-2xl transition border border-slate-200">Edit
                    Profile</button>
                <button
                    class="bg-sky-600 hover:bg-sky-700 text-white font-bold px-6 py-3 rounded-2xl transition shadow-xl shadow-sky-600/20">Message</button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                <h3 class="text-xl font-bold text-slate-900 mb-6">About</h3>
                <p class="text-slate-600 leading-relaxed">
                    <?php echo htmlspecialchars($user['bio'] ?? 'A dedicated maritime professional passionate about navigation and vessel safety. Seeking new challenges and career growth on deep-sea vessels.'); ?>
                </p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-900">Certificates & Licenses</h3>
                    <button onclick="document.getElementById('uploadModal').classList.remove('hidden')"
                        class="text-sky-600 hover:underline text-sm font-bold">+ Add New</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php if (empty($certs)): ?>
                        <p class="text-slate-400 text-sm italic col-span-2">No certificates uploaded yet.</p>
                    <?php else: ?>
                        <?php foreach ($certs as $cert): ?>
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center space-x-4">
                                <div
                                    class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-sky-600 shadow-sm border border-slate-100">
                                    <i class="fa-solid fa-file-contract"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-sm font-bold text-slate-800"><?php echo htmlspecialchars($cert['name']); ?>
                                    </h4>
                                    <p
                                        class="text-[10px] <?php echo $cert['verified'] ? 'text-emerald-500' : 'text-orange-400'; ?> font-bold uppercase tracking-wider">
                                        <?php echo $cert['verified'] ? 'Verified' : 'Pending Verification'; ?>
                                    </p>
                                </div>
                                <a href="<?php echo htmlspecialchars($cert['file_path']); ?>" target="_blank"
                                    class="text-slate-300 hover:text-sky-600"><i class="fa-solid fa-download"></i></a>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Upload Modal (Simple) -->
            <div id="uploadModal"
                class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] flex items-center justify-center p-6">
                <div class="bg-white rounded-[2rem] shadow-2xl w-full max-w-md p-8 relative">
                    <button onclick="document.getElementById('uploadModal').classList.add('hidden')"
                        class="absolute top-6 right-6 text-slate-400 hover:text-slate-600"><i
                            class="fa-solid fa-times text-xl"></i></button>
                    <h3 class="text-2xl font-bold text-slate-900 mb-6">Upload Certificate</h3>
                    <form action="upload_cert.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Certificate
                                Name</label>
                            <input type="text" name="cert_name" required placeholder="e.g. STCW BST"
                                class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 outline-none transition">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Issue
                                    Date</label>
                                <input type="date" name="issue_date"
                                    class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 outline-none transition text-sm">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Expiry
                                    Date</label>
                                <input type="date" name="expiry_date"
                                    class="w-full px-5 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-sky-500 outline-none transition text-sm">
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest ml-1">Document
                                (PDF/JPG)</label>
                            <input type="file" name="certificate" required
                                class="w-full text-sm block px-5 py-3 rounded-xl border border-dashed border-slate-300 bg-slate-50">
                        </div>
                        <button type="submit"
                            class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-4 rounded-xl transition shadow-xl shadow-sky-600/20">
                            Upload Now
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
                <h3 class="text-xl font-bold text-slate-900 mb-6">Skills</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="bg-sky-50 text-sky-600 px-3 py-1.5 rounded-xl text-xs font-bold">Navigation</span>
                    <span class="bg-sky-50 text-sky-600 px-3 py-1.5 rounded-xl text-xs font-bold">ARPA/Radar</span>
                    <span class="bg-sky-50 text-sky-600 px-3 py-1.5 rounded-xl text-xs font-bold">COLREGs</span>
                    <span class="bg-sky-50 text-sky-600 px-3 py-1.5 rounded-xl text-xs font-bold">ECDIS</span>
                    <span class="bg-sky-50 text-sky-600 px-3 py-1.5 rounded-xl text-xs font-bold">LSA/FFA</span>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>