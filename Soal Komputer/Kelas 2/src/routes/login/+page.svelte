<script lang="ts">
	import Nav from "$lib/components/Nav.svelte";
	import { onMount } from "svelte";

	let phone = "";
	let otp = "";
	let step = 1; // 1: input phone, 2: input otp
	let loading = false;
	let error = "";

	async function sendOtp() {
		loading = true;
		error = "";
		const res = await fetch("/api/auth.php?action=send_otp", {
			method: "POST",
			body: new URLSearchParams({ phone })
		});
		const data = await res.json();
		loading = false;
		if (data.is_success) {
			step = 2;
		} else {
			error = data.message;
		}
	}

	async function verifyOtp() {
		loading = true;
		error = "";
		const res = await fetch("/api/auth.php?action=verify_otp", {
			method: "POST",
			body: new URLSearchParams({ phone, otp })
		});
		const data = await res.json();
		loading = false;
		if (data.is_success) {
			localStorage.setItem("token", data.data.token);
			localStorage.setItem("user", JSON.stringify(data.data.user));
			window.location.href = "/";
		} else {
			error = data.message;
		}
	}
</script>

<Nav />

<main class="p-8 flex flex-col items-center justify-center min-h-[80vh]">
	<h1 class="text-4xl font-semibold mb-2">Sign in</h1>
	<p class="text-apple-ink-muted-80 mb-12">Login with your WhatsApp number.</p>

	<div class="w-full max-w-sm">
		{#if step === 1}
			<div class="space-y-4">
				<input
					type="tel"
					placeholder="Phone number (e.g. 0812...)"
					bind:value={phone}
					class="w-full p-4 rounded-apple-lg border border-apple-hairline focus:outline-apple-blue"
				/>
				<button
					on:click={sendOtp}
					disabled={loading}
					class="w-full apple-button-primary h-14 font-medium disabled:opacity-50"
				>
					{loading ? "Sending..." : "Continue with WhatsApp"}
				</button>
			</div>
		{:else}
			<div class="space-y-4">
				<input
					type="tel"
					maxlength="6"
					placeholder="Enter 6-digit OTP"
					bind:value={otp}
					class="w-full p-4 rounded-apple-lg border border-apple-hairline focus:outline-apple-blue text-center text-2xl tracking-[1em]"
				/>
				<button
					on:click={verifyOtp}
					disabled={loading}
					class="w-full apple-button-primary h-14 font-medium disabled:opacity-50"
				>
					{loading ? "Verifying..." : "Verify OTP"}
				</button>
				<button on:click={() => (step = 1)} class="w-full text-apple-blue hover:underline">
					Change number
				</button>
			</div>
		{/if}

		{#if error}
			<p class="mt-4 text-red-500 text-center">{error}</p>
		{/if}
	</div>
</main>
