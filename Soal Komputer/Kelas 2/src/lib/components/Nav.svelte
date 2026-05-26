<script lang="ts">
	import { Apple, Search, ShoppingBag } from "lucide-svelte";
</script>

<nav class="bg-black text-white h-[44px] flex items-center justify-between px-4 sticky top-0 z-50">
	<div class="flex items-center space-x-6 overflow-x-auto no-scrollbar">
		<a href="/" class="hover:text-gray-300 transition-colors">
			<Apple size={18} />
		</a>
		<a href="/matches" class="text-[12px] hover:text-gray-300 transition-colors whitespace-nowrap">Matches</a>
		<a href="/teams" class="text-[12px] hover:text-gray-300 transition-colors whitespace-nowrap">Teams</a>
		<a href="/news" class="text-[12px] hover:text-gray-300 transition-colors whitespace-nowrap">News</a>
	</div>
	<div class="flex items-center space-x-4">
		<Search size={16} class="hover:text-gray-300 cursor-pointer" />
		<a href="/login">
			<ShoppingBag size={16} class="hover:text-gray-300 cursor-pointer" />
		</a>
	</div>
</nav>

<style>
	.no-scrollbar::-webkit-scrollbar {
		display: none;
	}
	.no-scrollbar {
		-ms-overflow-style: none;
		scrollbar-width: none;
	}
</style>
