<script>
	// @ts-nocheck
	export let onClick = ()=>{};

	export let type = 'button'; // Default button type
	export let disabled = false;
	export let tabindex = "0"; // Control disabled state


	function handleClick(event) {
		if (onClick) {
			onClick(event)
		}
		
	}
</script>

<button {type} {disabled} {tabindex} on:click={handleClick}>
	<slot />
</button>

<style>

	button {
		width: 100%;
		height: 3rem;
		background-color: var(--button-active);
		border: none;
		border-radius: .5rem;
		color: var(--button-text-active);
		font-size: 1.2rem;
		cursor: pointer;
	}
    button:hover {
		background-color: var(--button-active-hover);
        color: var(--button-text-active-hover);
	}

</style>
