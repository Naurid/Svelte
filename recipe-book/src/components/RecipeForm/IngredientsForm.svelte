<script>
	/**
	 * @type {string}
	 */
	 export let ingredient_subtitle = '';
	/**
	 * @type {string}
	 */
	export let ingredient_name = '';
	/**
	 * @type {any}
	 */
	export let ingredient_quantity= '';

	export let ingredientIndex;
	export let subtitleIndex;
</script>

<div class="ingredientContainer">
	<div class="subContainer">
		<p>Ingredient:</p>
		<input
		name='recipe[subtitle][{subtitleIndex}][ingredients][{ingredientIndex}][name]'
			type="text"
			bind:value={ingredient_name}
			placeholder="Type the name of the ingredient here.."
		/>
	</div>
	<div class="subContainer">
		<p>Quantity:</p>
		<input
		name='recipe[subtitle][{subtitleIndex}][ingredients][{ingredientIndex}][quantity]'
			type="number"
			bind:value={ingredient_quantity}
			placeholder="Type the desired quantity here in grams..."
		/>
		<p>g</p>
	</div>
</div>

<style>

    .subContainer{
        width: 100%;
        display: flex;
        align-items: center;
        gap: 1%;
    }

	.ingredientContainer {
		display: flex;
		justify-content: center;
		align-items: center;
        gap: 1%;
		width: 100%;
	}

	p {
		text-align: start;
        font-family: system-ui,
			-apple-system,
			BlinkMacSystemFont,
			'Segoe UI',
			Roboto,
			Oxygen,
			Ubuntu,
			Cantarell,
			'Open Sans',
			'Helvetica Neue',
			sans-serif;;
		margin: 0;
	}

	input {
		width: 80%;
		height: 3rem;
		border-radius: 1rem;
		padding-left: 1rem;
	}

    
</style>
