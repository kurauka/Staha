<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include 'includes/header.php';
require_once 'config/db.php';

$userId = $_SESSION['user_id'];

// Get sea time summary (simulated logic)
$totalDaysRequired = 360; // For next license upgrade
$completedDays = 145;
$percentage = round(($completedDays / $totalDaysRequired) * 100);

// Get work history
$stmt = $pdo->prepare("SELECT * FROM work_history WHERE user_id = ? ORDER BY start_date DESC");
$stmt->execute([$userId]);
$history = $stmt->fetchAll();
?>

<main class="max-w-7xl mx-auto px-6 md:px-12 py-10">
    <div class="mb-12">
        <h1 class="text-4xl font-bold text-slate-900 mb-2">SeaTime Tracker</h1>
        <p class="text-slate-500 text-lg">Monitor your onboard service days and certificate eligibility.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
        <!-- Progress Card -->
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-xl border border-slate-100 p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">License Upgrade Progress</h3>
                    <p class="text-slate-400 text-sm">Target: OOW (Deck) / 2nd Officer</p>
                </div>
                <div class="text-right">
                    <span class="text-3xl font-black text-sky-600">
                        <?php echo $completedDays; ?>
                    </span>
                    <span class="text-slate-300 font-bold">/
                        <?php echo $totalDaysRequired; ?> Days
                    </span>
                </div>
            </div>

            <div class="w-full bg-slate-100 h-6 rounded-full overflow-hidden mb-4 p-1">
                <div class="bg-gradient-to-r from-sky-400 to-indigo-600 h-full rounded-full transition-all duration-1000 flex items-center justify-end px-2"
                    style="width: <?php echo $percentage; ?>%">
                    <span class="text-[10px] text-white font-bold">
                        <?php echo $percentage; ?>%
                    </span>
                </div>
            </div>

            <p class="text-sm text-slate-500 italic">
                <i class="fa-solid fa-circle-info mr-1 text-sky-400"></i>
                You need
                <?php echo $totalDaysRequired - $completedDays; ?> more days of sea service to be eligible for your next
                COC upgrade.
            </p>
        </div>

        <!-- Quick Add -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-3xl shadow-xl p-8 text-white">
            <h3 class="text-lg font-bold mb-6">Log New Sea Service</h3>
            <form action="save_seatime.php" method="POST" class="space-y-4">
                <input type="text" placeholder="Vessel Name"
                    class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-2 text-sm focus:border-sky-400 outline-none">
                <div class="grid grid-cols-2 gap-4">
                    <input type="date" title="Start Date"
                        class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-2 text-sm focus:border-sky-400 outline-none">
                    <input type="date" title="End Date"
                        class="w-full bg-slate-700/50 border border-slate-600 rounded-xl px-4 py-2 text-sm focus:border-sky-400 outline-none">
                </div>
                <button
                    class="w-full bg-sky-500 hover:bg-sky-600 transition font-bold py-3 rounded-xl shadow-lg shadow-sky-500/20 text-sm">
                    Add Record
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="p-8 border-b border-slate-50">
            <h3 class="text-xl font-bold text-slate-900">Sea Service History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 text-[10px] uppercase tracking-widest font-bold">
                        <th class="px-8 py-4">Vessel</th>
                        <th class="px-8 py-4">Type</th>
                        <th class="px-8 py-4">Rank</th>
                        <th class="px-8 py-4">Duration</th>
                        <th class="px-8 py-4">Days</th>
                        <th class="px-8 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    <?php if (empty($history)): ?>
                        <!-- Simulated History -->
                        <tr>
                            <td class="px-8 py-4">
                                <span class="font-bold text-slate-800">MV Ocean Breeze</span>
                            </td>
                            <td class="px-8 py-4 text-slate-500 text-sm">Bulk Carrier</td>
                            <td class="px-8 py-4 text-slate-500 text-sm">Deck Cadet</td>
                            <td class="px-8 py-4 text-slate-500 text-sm">Jan 10, 2024 - Apr 15, 2024</td>
                            <td class="px-8 py-4"><span
                                    class="bg-sky-50 text-sky-600 font-bold px-3 py-1 rounded-lg text-xs">96</span></td>
                            <td class="px-8 py-4 text-right">
                                <button class="text-slate-300 hover:text-slate-600"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-8 py-4">
                                <span class="font-bold text-slate-800">MT Silver Sun</span>
                            </td>
                            <td class="px-8 py-4 text-slate-500 text-sm">Oil Tanker</td>
                            <td class="px-8 py-4 text-slate-500 text-sm">Deck Cadet</td>
                            <td class="px-8 py-4 text-slate-500 text-sm">Sep 05, 2023 - Oct 24, 2023</td>
                            <td class="px-8 py-4"><span
                                    class="bg-sky-50 text-sky-600 font-bold px-3 py-1 rounded-lg text-xs">49</span></td>
                            <td class="px-8 py-4 text-right">
                                <button class="text-slate-300 hover:text-slate-600"><i
                                        class="fa-solid fa-pen-to-square"></i></button>
                            </td>
                        </tr>
                    <?php else: ?>
                        <!-- Dynamic history would go here -->
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>