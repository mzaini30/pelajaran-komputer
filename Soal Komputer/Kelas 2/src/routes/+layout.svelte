<script lang="ts">
	import "../app.css";
	import { onMount } from "svelte";
	import { Howl } from "howler";

	// Beep sound setup
	let beep: Howl;

	onMount(() => {
		beep = new Howl({
			src: ["https://www.soundjay.com/button/button-16.mp3"],
			volume: 0.5
		});

		window.addEventListener("click", (e) => {
			const target = e.target as HTMLElement;
			if (target.tagName === "BUTTON" || target.tagName === "A" || target.closest("button") || target.closest("a")) {
				if (beep) beep.play();
			}
		});
	});

	export function playBeep() {
		if (beep) beep.play();
	}
</script>

<div class="min-h-screen bg-apple-canvas font-sans text-apple-ink overflow-x-hidden">
	<div class="max-w-[600px] mx-auto min-h-screen bg-apple-canvas shadow-xl relative">
		<slot />
	</div>
</div>

<style>
	:global(body) {
		background-color: #f5f5f7;
	}
</style>
