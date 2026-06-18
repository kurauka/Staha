<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}
require_once '../config/db.php';
include '../includes/header.php';

// Handle verification toggle
if (isset($_GET['verify_cert'])) {
    $certId = $_GET['verify_cert'];
    $status = $_GET['status'];
    $stmt = $pdo->prepare("UPDATE certificates SET verified = ? WHERE id = ?");
    $stmt->execute([$status, $certId]);
    header("Location: users.php?msg=updated");
    exit();
}

$users = $pdo->query("SELECT * FROM users WHERE role != 'admin' ORDER BY created_at DESC")->fetchAll();
?>

<main class="max-w-7xl mx-auto px-6 md:px-12 py-10">
    <div class="mb-10">
        <a href="index.php" class="text-sky-600 font-bold text-sm hover:underline flex items-center mb-4">
            <i class="fa-solid fa-arrow-left mr-2"></i> Back to Dashboard
        </a>
        <h1 class="text-4xl font-bold text-slate-900 mb-2 font-['Outfit']">User Management</h1>
        <p class="text-slate-500">Review Seafarers and verify their documentation.</p>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div
            class="bg-emerald-50 text-emerald-600 p-4 rounded-2xl mb-6 text-sm font-medium border border-emerald-100 flex items-center">
            <i class="fa-solid fa-check-circle mr-2"></i> Certificate status updated successfully.
        </div>
    <?php endif; ?>

    <div class="space-y-8">
        <?php foreach ($users as $user): ?>
            <div class="bg-white rounded-[2rem] shadow-xl border border-slate-50 overflow-hidden">
                <div
                    class="p-8 bg-slate-50/50 flex flex-col md:flex-row justify-between items-start md:items-center gap-6 border-b border-slate-100">
                    <div class="flex items-center space-x-4">
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['name']); ?>&background=random"
                            class="w-14 h-14 rounded-2xl shadow-sm">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">
                                <?php echo htmlspecialchars($user['name']); ?>
                            </h3>
                            <p class="text-sm text-slate-500 font-medium">
                                <?php echo htmlspecialchars($user['rank'] ?: 'No Rank Specified'); ?> •
                                <?php echo htmlspecialchars($user['email']); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Uploaded Certificates</h4>
                    <?php
                    $certs = $pdo->prepare("SELECT * FROM certificates WHERE user_id = ?");
                    $certs->execute([$user['id']]);
                    $userCerts = $certs->fetchAll();
                    ?>

                    <?php if (empty($userCerts)): ?>
                        <p class="text-slate-400 text-sm italic">No certificates uploaded by this user.</p>
                    <?php else: ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <?php foreach ($userCerts as $c): ?>
                                <div
                                    class="p-6 rounded-2xl bg-white border border-slate-100 flex justify-between items-center hover:border-sky-100 transition">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-sky-50 rounded-xl flex items-center justify-center text-sky-600">
                                            <i class="fa-solid fa-file-contract"></i>
                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-slate-800">
                                                <?php echo htmlspecialchars($c['name']); ?>
                                            </p>
                                            <a href="../<?php echo htmlspecialchars($c['file_path']); ?>" target="_blank"
                                                class="text-[10px] text-sky-600 font-bold hover:underline">View Document</a>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-4">
                                        <?php if ($c['verified']): ?>
                                            <span
                                                class="text-[10px] bg-emerald-50 text-emerald-600 px-3 py-1.5 rounded-full font-bold uppercase tracking-wider">Verified</span>
                                            <a href="users.php?verify_cert=<?php echo $c['id']; ?>&status=0"
                                                class="text-slate-300 hover:text-red-500 transition" title="Revoke Verification"><i
                                                    class="fa-solid fa-rotate-left text-sm"></i></a>
                                        <?php else: ?>
                                            <a href="users.php?verify_cert=<?php echo $c['id']; ?>&status=1"
                                                class="bg-emerald-500 hover:bg-emerald-600 text-white text-[10px] font-bold px-4 py-2 rounded-lg transition uppercase tracking-wider">Verify
                                                Now</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>