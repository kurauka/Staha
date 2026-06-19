<?php
session_start();
require_once 'config/db.php';
include 'includes/header.php';

// Fetch jobs with filters
$rank = $_GET['rank'] ?? '';
$vessel = $_GET['vessel'] ?? '';

$query = "SELECT * FROM jobs WHERE 1=1";
$params = [];

if ($rank) {
    $query .= " AND `rank` LIKE ?";
    $params[] = "%$rank%";
}
if ($vessel) {
    $query .= " AND vessel_type LIKE ?";
    $params[] = "%$vessel%";
}

$query .= " ORDER BY created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$jobs = $stmt->fetchAll();
?>

<main class="max-w-7xl mx-auto px-6 md:px-12 py-10">
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
        <div>
            <h1 class="text-4xl font-bold text-slate-900 mb-2">Maritime Job Board</h1>
            <p class="text-slate-500 text-lg">Aggregating the best opportunities from across the globe.</p>
        </div>

        <form class="flex flex-wrap gap-4 bg-white p-4 rounded-2xl shadow-xl border border-slate-100 items-end">
            <div class="space-y-1">
                <label class="text-[10px] uppercase font-bold text-slate-400 tracking-wider ml-1">Rank</label>
                <input type="text" name="rank" id="rankInput" value="<?php echo htmlspecialchars($rank); ?>"
                    placeholder="e.g. 3rd Officer"
                    class="px-4 py-2 bg-slate-50 border border-slate-100 rounded-xl text-sm focus:ring-2 focus:ring-sky-100 outline-none w-40">
            </div>
            <div class="space-y-1">
                <label class="text-[10px] uppercase font-bold text-slate-400 tracking-wider ml-1">Vessel Type</label>
                <input type="text" name="vessel" id="vesselInput" value="<?php echo htmlspecialchars($vessel); ?>"
                    placeholder="e.g. Tanker"
                    class="px-4 py-2 bg-slate-50 border border-slate-100 rounded-xl text-sm focus:ring-2 focus:ring-sky-100 outline-none w-40">
            </div>
            <button type="submit"
                class="bg-sky-600 hover:bg-sky-700 text-white font-bold px-6 py-2 rounded-xl transition shadow-lg shadow-sky-600/20 text-sm h-[42px]">
                Search
            </button>
            <button type="button" id="deepSearchBtn"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-2 rounded-xl transition shadow-lg shadow-indigo-600/20 text-sm h-[42px] flex items-center">
                <i class="fa-solid fa-cloud-bolt mr-2"></i> Deep Search
            </button>
        </form>
    </div>

    <!-- Loading State -->
    <div id="loadingState" class="hidden">
        <div class="bg-white rounded-3xl p-12 text-center border border-dashed border-indigo-200 mb-8">
            <div class="flex justify-center mb-4">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-indigo-600"></div>
            </div>
            <h3 class="text-xl font-bold text-slate-800">Scraping the deep web...</h3>
            <p class="text-slate-500">Searching verified maritime sources for live opportunities.</p>
        </div>
    </div>

    <div id="jobsList" class="grid grid-cols-1 gap-6">
        <?php if (isset($_GET['saved'])): ?>
            <div
                class="bg-emerald-50 text-emerald-600 p-4 rounded-2xl mb-2 text-sm font-medium border border-emerald-100 flex items-center">
                <i class="fa-solid fa-check-circle mr-2"></i> Job saved to your bookmarks!
            </div>
        <?php endif; ?>

        <?php if (empty($jobs)): ?>
            <div class="bg-white rounded-3xl p-12 text-center border border-dashed border-slate-200">
                <div
                    class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                    <i class="fa-solid fa-anchor text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800">No jobs found</h3>
                <p class="text-slate-500">Try adjusting your filters or use <b>Deep Search</b> to find live openings.</p>
            </div>
        <?php else: ?>
            <?php foreach ($jobs as $job): ?>
                <div
                    class="bg-white rounded-3xl p-6 md:p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-50 group flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div class="flex items-center space-x-6">
                        <div
                            class="w-16 h-16 bg-sky-50 rounded-2xl flex items-center justify-center text-sky-600 font-bold text-xl group-hover:bg-sky-600 group-hover:text-white transition duration-300">
                            <?php echo strtoupper(substr($job['company'], 0, 1)); ?>
                        </div>
                        <div>
                            <div class="flex items-center space-x-3 mb-1">
                                <h3 class="text-xl font-bold text-slate-900">
                                    <?php echo htmlspecialchars($job['title']); ?>
                                </h3>
                                <?php if ($job['source'] !== 'Manual'): ?>
                                    <span
                                        class="bg-indigo-100 text-indigo-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">Verified</span>
                                <?php else: ?>
                                    <span
                                        class="bg-emerald-100 text-emerald-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">New</span>
                                <?php endif; ?>
                            </div>
                            <p class="text-slate-500 font-medium mb-2">
                                <?php echo htmlspecialchars($job['company']); ?> • <span class="text-slate-400 font-normal">
                                    <?php echo htmlspecialchars($job['vessel_type']); ?>
                                </span>
                            </p>
                            <div class="flex flex-wrap gap-2">
                                <span
                                    class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-semibold flex items-center">
                                    <i class="fa-solid fa-location-dot mr-1.5 opacity-50"></i>
                                    <?php echo htmlspecialchars($job['location'] ?: 'Worldwide'); ?>
                                </span>
                                <span
                                    class="bg-slate-100 text-slate-600 px-3 py-1 rounded-lg text-xs font-semibold flex items-center">
                                    <i class="fa-solid fa-clock mr-1.5 opacity-50"></i>
                                    <?php echo date('M d, Y', strtotime($job['created_at'])); ?>
                                </span>
                                <?php if ($job['source']): ?>
                                    <span
                                        class="bg-indigo-50 text-indigo-500 px-3 py-1 rounded-lg text-xs font-semibold flex items-center border border-indigo-100">
                                        <i class="fa-solid fa-link mr-1.5 opacity-50"></i>
                                        via <?php echo htmlspecialchars($job['source']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 w-full md:w-auto">
                        <a href="save_job.php?job_id=<?php echo $job['id']; ?>"
                            class="flex-1 md:flex-none p-3 rounded-xl border border-slate-200 text-slate-400 hover:text-sky-600 hover:bg-sky-50 transition text-center"
                            title="Save Job">
                            <i class="fa-regular fa-bookmark"></i>
                        </a>
                        <a href="<?php echo htmlspecialchars($job['link']); ?>" target="_blank"
                            class="flex-1 md:flex-none bg-sky-600 hover:bg-sky-700 text-white font-bold px-8 py-3 rounded-xl transition shadow-lg shadow-sky-600/20 text-center">
                            Apply Now
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</main>

<script>
    document.getElementById('deepSearchBtn').addEventListener('click', async function () {
        const rank = document.getElementById('rankInput').value;
        const vessel = document.getElementById('vesselInput').value;

        const loadingState = document.getElementById('loadingState');
        const jobsList = document.getElementById('jobsList');
        const btn = this;

        // UI Feedback
        btn.disabled = true;
        btn.classList.add('opacity-50', 'cursor-not-allowed');
        loadingState.classList.remove('hidden');

        try {
            const response = await fetch(`api/scrape_jobs_api.php?rank=${encodeURIComponent(rank)}&vessel=${encodeURIComponent(vessel)}`);
            const data = await response.json();

            if (data.status === 'success') {
                // Refresh the page to show results (simpler than manual DOM insertion for now)
                window.location.reload();
            } else {
                alert('Something went wrong with the deep search.');
            }
        } catch (error) {
            console.error('Deep Search Error:', error);
            alert('Failed to perform deep search. Please try again.');
        } finally {
            btn.disabled = false;
            btn.classList.remove('opacity-50', 'cursor-not-allowed');
            loadingState.classList.add('hidden');
        }
    });
</script>

<?php include 'includes/footer.php'; ?>