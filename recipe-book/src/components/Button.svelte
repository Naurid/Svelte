<script>
	// @ts-nocheck

	import { createEventDispatcher } from 'svelte';

	export let type = 'button'; // Default button type
	export let disabled = false;
	export let tabindex = "0"; // Control disabled state

	const dispatch = createEventDispatcher();

	function handleClick(event) {
		// Dispatch the click event to the parent
		dispatch('click', event);
	}
</script>

<button {type} {disabled} {tabindex} on:click={handleClick}>
	<slot />
</button>

<style>
    @import '../main_style.css';

	button {
		width: 100%;
		height: 3rem;
		background-color: var(--button-active);
		border: none;
		border-radius: .5rem;
		color: var(--button-text-color);
		font-size: 1.2rem;
		cursor: pointer;
	}
    button:hover {
		background-color: var(--button-active-hover);
        color: var(--button-text-color-hover);
	}

</style>
