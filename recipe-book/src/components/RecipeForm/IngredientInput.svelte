<script>
	/**
	 * @type {string}
	 */
	export let ingredient_name = '';
	/**
	 * @type {any}
	 */
	export let ingredient_quantity = '';

	export let ingredientID;
	export let subtitleIndex;

	let quantityType = ['g', 'units', 'l', 'ml', 'kg'];
</script>

<div class="ingredientContainer">
	<div class="subContainer">
		<p>Ingredient:</p>
		<input
			name="recipe[subtitle][{subtitleIndex}][ingredients][{ingredientID}][name]"
			type="text"
			bind:value={ingredient_name}
			placeholder="Type the name of the ingredient here.."
		/>
	</div>
	<div class="subContainer">
		<p>Quantity:</p>
		<input
			name="recipe[subtitle][{subtitleIndex}][ingredients][{ingredientID}][quantity]"
			type="number"
			bind:value={ingredient_quantity}
			placeholder="Type the desired quantity here in grams..."
			min="0"
		/>
		<select
			name="recipe[subtitle][{subtitleIndex}][ingredients][{ingredientID}][ingredient_type]"
			id="quantity"
		>	
			{#each quantityType as type}
				<option value={type}>{type}</option>
			{/each}
		</select>
	</div>
</div>

<style>
	.subContainer {
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
		margin: 0;
		color: var(--black);
		font-size: 150%;
	}

	input {
		width: 80%;
		height: 3rem;
		border: 1px solid var(--white);
		background-color: var(--input-bg);
		padding-left: 1rem;
		text-align: center;
		color: var(--white);
		font-size: 140%;
	}

	/* For Chrome, Safari, Edge, Opera */
	input[type='number']::-webkit-outer-spin-button,
	input[type='number']::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	/* For Firefox */
	input[type='number'] {
		-moz-appearance: textfield;
	}
	select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    padding: 16px;
    font-size: 16px;
    color: var(--white);
    background-color: var(--input-bg);
    border: 1px solid #ccc;
    width: 100%;
    max-width: 200px;
    outline: none;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;

    /* Custom arrow */
    background-image: url("data:image/svg+xml;utf8,<svg fill='%23000' height='24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 1em;
    padding-right: 30px;
  }

  select:focus {
    border-color: var(--white);
    box-shadow: 0 0 5px var(--white);
  }

  select option {
    padding: 10px;
  }

</style>
