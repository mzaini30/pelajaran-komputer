<script lang="ts">
	import Nav from "$lib/components/Nav.svelte";
	import { onMount } from "svelte";

	let news: any[] = [];
	let matches: any[] = [];

	onMount(async () => {
		const resNews = await fetch("/api/news.php");
		const dataNews = await resNews.json();
		if (dataNews.is_success) news = dataNews.data;

		const resMatches = await fetch("/api/matches.php");
		const dataMatches = await resMatches.json();
		if (dataMatches.is_success) matches = dataMatches.data;
	});

	function getImageUrl(url: string, w = 600) {
		if (!url) return "";
		const cleanUrl = url.replace(/^https?:\/\//, "");
		return `https://i0.wp.com/${cleanUrl}?w=${w}`;
	}
</script>

<Nav />

<main>
	<!-- Hero Tile -->
	<section class="apple-tile bg-apple-canvas min-h-[80vh] flex flex-col justify-center">
		<h1 class="text-5xl font-semibold tracking-tight text-apple-ink mb-2">Champions League</h1>
		<p class="text-2xl text-apple-ink mb-6">The stage is set for glory.</p>
		<div class="flex space-x-4">
			<a href="/matches" class="text-apple-blue text-lg hover:underline">Learn more ></a>
			<a href="/matches" class="text-apple-blue text-lg hover:underline">View fixtures ></a>
		</div>
		<img
			src={getImageUrl("https://imgchest.com/p/dl7pvg2z7ox")}
			alt="Hero"
			class="mt-12 w-full max-w-md mx-auto drop-shadow-2xl"
		/>
	</section>

	<!-- News Tiles (Alternating) -->
	{#each news as item, i}
		<section
			class="apple-tile min-h-[70vh] {i % 2 === 0 ? 'bg-apple-tile-1 text-white' : 'bg-apple-parchment text-apple-ink'}"
		>
			<h2 class="text-4xl font-semibold mb-2">{item.title}</h2>
			<p class="text-xl mb-6 opacity-80">{item.content}</p>
			<a href="/news/{item.id}" class="apple-button-primary mb-12">Read full story</a>
			<img
				src={getImageUrl(item.image)}
				alt={item.title}
				class="w-full max-w-sm mx-auto rounded-apple-lg shadow-lg"
			/>
		</section>
	{/each}

	<!-- Matches Card Grid -->
	<section class="p-8 bg-apple-canvas">
		<h2 class="text-3xl font-semibold mb-8 text-center">Featured Matches</h2>
		<div class="grid grid-cols-1 gap-6">
			{#each matches as match}
				<div class="bg-apple-canvas border border-apple-hairline rounded-apple-lg p-6 flex flex-col items-center shadow-sm">
					<div class="flex items-center justify-between w-full mb-4 px-4">
						<span class="text-xl font-medium">{match.team_a}</span>
						<div class="flex flex-col items-center">
							<span class="text-3xl font-bold">{match.score_a} - {match.score_b}</span>
							<span class="text-[10px] text-red-500 font-bold uppercase tracking-widest">{match.status}</span>
						</div>
						<span class="text-xl font-medium">{match.team_b}</span>
					</div>
					<a href="/matches" class="text-apple-blue hover:underline">Match Details ></a>
				</div>
			{/each}
		</div>
	</section>
</main>

<footer class="bg-apple-parchment p-12 text-center text-apple-ink-muted-80 border-t border-apple-divider-soft">
	<p class="text-sm">© 2026 Football Info. Built with Apple aesthetics.</p>
</footer>
