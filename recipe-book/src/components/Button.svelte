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
		background-color: var(--bg);
		border: none;
		color: var(--white);
		font-size: 1.2rem;
		cursor: pointer;
	}
    button:hover {
		background-color: var(--navbar-hover-font-color);
        color: var(--navbar-font-color);
	}

</style>
