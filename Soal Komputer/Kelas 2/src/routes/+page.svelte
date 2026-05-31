<script lang="ts">
	import Nav from "$lib/components/Nav.svelte";
	import { onMount } from "svelte";

	// Fungsi efek suara
	function playBeep() {
		const context = new (window.AudioContext || (window as any).webkitAudioContext)();
		const oscillator = context.createOscillator();
		const gain = context.createGain();
		oscillator.connect(gain);
		gain.connect(context.destination);
		oscillator.type = "sine";
		oscillator.frequency.setValueAtTime(880, context.currentTime);
		gain.gain.setValueAtTime(0.1, context.currentTime);
		gain.gain.exponentialRampToValueAtTime(0.01, context.currentTime + 0.1);
		oscillator.start();
		oscillator.stop(context.currentTime + 0.1);
	}

	function getImageUrl(url: string, w = 600) {
		if (!url) return "";
		// Jika path lokal, jangan pakai i0.wp.com kecuali URL publik
		if (url.startsWith("/") || url.startsWith("./")) return url;
		const cleanUrl = url.replace(/^https?:\/\//, "");
		return `https://i0.wp.com/${cleanUrl}?w=${w}`;
	}

	const standings = [
		{ rank: 1, team: "Manchester City", mp: 38, w: 28, d: 7, l: 3, gf: 96, ga: 34, gd: 62, pts: 91 },
		{ rank: 2, team: "Arsenal", mp: 38, w: 28, d: 5, l: 5, gf: 91, ga: 29, gd: 62, pts: 89 },
		{ rank: 3, team: "Liverpool", mp: 38, w: 24, d: 10, l: 4, gf: 86, ga: 41, gd: 45, pts: 82 },
		{ rank: 4, team: "Aston Villa", mp: 38, w: 20, d: 8, l: 10, gf: 76, ga: 61, gd: 15, pts: 68 }
	];

	const topScorers = [
		{ name: "Erling Haaland", team: "Man City", goals: 27, assists: 5, photo: "/gambar/haaland.jpg" },
		{ name: "Cole Palmer", team: "Chelsea", goals: 22, assists: 11, photo: "/gambar/cole.jpg" },
		{ name: "Alexander Isak", team: "Newcastle", goals: 21, assists: 2, photo: "/gambar/alexander.jpg" }
	];

	const matches = [
		{ 
			home: "Real Madrid", 
			away: "Dortmund", 
			homeLogo: "/gambar/real madrid.png",
			awayLogo: "/gambar/borussia-dortmund-logo-png_seeklogo-293083.png",
			date: "02 JUN", 
			time: "02:00", 
			league: "Liga Champions", 
			status: "Mendatang" 
		},
		{ 
			home: "Indonesia", 
			away: "Iraq", 
			homeLogo: "/gambar/indonesia.jpg",
			awayLogo: "/gambar/flag-of-republic-of-iraq-on-a-textured-background-concept-collage-photo.jpg",
			date: "06 JUN", 
			time: "16:00", 
			league: "Kualifikasi Piala Dunia", 
			status: "Langsung" 
		}
	];
</script>

<Nav />

<main class="max-w-[600px] mx-auto bg-apple-canvas min-h-screen pb-20">
	<!-- Hero: Final Liga Champions -->
	<section class="apple-tile bg-apple-canvas pt-16 pb-12 px-6 text-center border-b border-apple-hairline">
		<h1 class="text-5xl font-semibold tracking-tighter text-apple-ink mb-2">Liga Champions</h1>
		<p class="text-2xl text-apple-ink-muted-80 mb-6 font-light">Jalan menuju Wembley berakhir di sini.</p>
		<div class="flex justify-center space-x-6 mb-10">
			<button on:click={playBeep} class="text-apple-blue text-lg hover:underline">Pelajari selengkapnya ></button>
			<button on:click={playBeep} class="text-apple-blue text-lg hover:underline">Beli tiket ></button>
		</div>
		<div class="relative group">
			<img
				src="/gambar/ucl.jpg"
				alt="UCL Trophy"
				class="w-full max-w-xs mx-auto drop-shadow-2xl transform group-hover:scale-105 transition-transform duration-500"
			/>
		</div>
	</section>

	<!-- Match Center (Mendatang/Langsung) -->
	<section class="p-6 bg-apple-parchment">
		<h2 class="text-2xl font-semibold mb-6 text-apple-ink">Pusat Pertandingan</h2>
		<div class="space-y-4">
			{#each matches as match}
				<div
					class="bg-white rounded-apple-lg p-5 border border-apple-hairline shadow-sm hover:shadow-md transition-shadow cursor-pointer"
					on:click={playBeep}
				>
					<div class="flex justify-between items-center mb-3">
						<span class="text-[10px] font-bold uppercase tracking-widest text-apple-ink-muted-48">{match.league}</span>
						<span class="text-[10px] font-bold uppercase tracking-widest {match.status === 'Langsung' ? 'text-red-500' : 'text-apple-blue'}">{match.status}</span>
					</div>
					<div class="flex justify-between items-center px-2">
						<div class="flex flex-col items-center w-1/3">
							<img src={match.homeLogo} alt={match.home} class="w-12 h-12 object-contain mb-2" />
							<span class="text-sm font-medium text-center">{match.home}</span>
						</div>
						<div class="flex flex-col items-center">
							<span class="text-xl font-bold">{match.time}</span>
							<span class="text-[10px] text-apple-ink-muted-48">{match.date}</span>
						</div>
						<div class="flex flex-col items-center w-1/3">
							<img src={match.awayLogo} alt={match.away} class="w-12 h-12 object-contain mb-2" />
							<span class="text-sm font-medium text-center">{match.away}</span>
						</div>
					</div>
				</div>
			{/each}
		</div>
	</section>

	<!-- Tabel Klasemen -->
	<section class="p-6 bg-white">
		<h2 class="text-2xl font-semibold mb-6 text-apple-ink">Klasemen Liga Inggris</h2>
		<div class="overflow-hidden border border-apple-hairline rounded-apple-lg">
			<table class="w-full text-left text-sm">
				<thead class="bg-apple-parchment text-apple-ink-muted-48 uppercase text-[10px] tracking-wider">
					<tr>
						<th class="px-4 py-3">Pos</th>
						<th class="px-4 py-3">Tim</th>
						<th class="px-4 py-3 text-center">Main</th>
						<th class="px-4 py-3 text-center">SG</th>
						<th class="px-4 py-3 text-right">Poin</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-apple-hairline">
					{#each standings as team}
						<tr class="hover:bg-apple-surface-pearl transition-colors cursor-pointer" on:click={playBeep}>
							<td class="px-4 py-3 font-medium text-apple-ink-muted-48">{team.rank}</td>
							<td class="px-4 py-3 font-semibold text-apple-ink">{team.team}</td>
							<td class="px-4 py-3 text-center text-apple-ink-muted-48">{team.mp}</td>
							<td class="px-4 py-3 text-center text-apple-ink-muted-48">{team.gd}</td>
							<td class="px-4 py-3 text-right font-bold text-apple-ink">{team.pts}</td>
						</tr>
					{/each}
				</tbody>
			</table>
		</div>
		<button on:click={playBeep} class="w-full text-center py-4 text-apple-blue text-sm hover:underline">Lihat klasemen lengkap ></button>
	</section>

	<!-- Grid Pencetak Gol Terbanyak -->
	<section class="p-6 bg-apple-parchment">
		<h2 class="text-2xl font-semibold mb-6 text-apple-ink">Perebutan Sepatu Emas</h2>
		<div class="grid grid-cols-1 gap-4">
			{#each topScorers as player}
				<div
					class="bg-white border border-apple-hairline rounded-apple-lg p-4 flex items-center space-x-4 shadow-sm hover:shadow-md transition-shadow cursor-pointer"
					on:click={playBeep}
				>
					<img
						src={player.photo}
						alt={player.name}
						class="w-16 h-16 rounded-full object-cover bg-apple-parchment"
					/>
					<div class="flex-grow">
						<h3 class="font-semibold text-apple-ink">{player.name}</h3>
						<p class="text-xs text-apple-ink-muted-48">{player.team}</p>
					</div>
					<div class="text-right">
						<span class="block text-xl font-bold text-apple-ink">{player.goals}</span>
						<span class="text-[8px] uppercase font-bold tracking-widest text-apple-ink-muted-48">Gol</span>
					</div>
				</div>
			{/each}
		</div>
	</section>

	<!-- Info Footer -->
	<section class="p-12 text-center bg-white border-t border-apple-divider-soft">
		<h3 class="text-lg font-semibold mb-4 text-apple-ink">Jangan lewatkan setiap momen.</h3>
		<p class="text-sm text-apple-ink-muted-48 mb-8">Dapatkan berita sepak bola terbaru dan skor langsung di saku Anda.</p>
		<div class="flex flex-col items-center space-y-4">
			<button on:click={playBeep} class="apple-button-primary px-10">Berlangganan Sekarang</button>
			<p class="text-[10px] text-apple-ink-muted-48">Tersedia di iOS dan Android</p>
		</div>
	</section>
</main>

<footer class="bg-apple-parchment p-12 text-center text-apple-ink-muted-48 border-t border-apple-divider-soft">
	<p class="text-[10px] mb-2 uppercase tracking-widest">Football Hub 2026</p>
	<p class="text-xs">© 2026 Zen Pelajaran Komputer. Hak cipta dilindungi undang-undang.</p>
</footer>

<style>
	/* Apple UI Utilities based on DESIGN.md */
	:global(.apple-tile) {
		@apply flex flex-col justify-center overflow-hidden;
	}
	:global(.apple-button-primary) {
		@apply bg-apple-blue text-white rounded-full px-6 py-3 text-sm font-medium hover:bg-[#0071e3] transition-colors active:scale-95;
	}
	:global(.rounded-apple-lg) {
		border-radius: 18px;
	}
	:global(.rounded-apple-md) {
		border-radius: 11px;
	}
</style>
