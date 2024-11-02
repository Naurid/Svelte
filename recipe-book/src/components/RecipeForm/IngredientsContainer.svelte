<script>
	import Button from '../Button.svelte';
	import IngredientInput from './IngredientInput.svelte';

	export let index;
	/**
	 * @type {any}
	 */
    export let subtitle;
    /**
	 * @type {any[]}
	 */
    export let ingredients = [];

     function addIngredient(){
		ingredients = [...ingredients, { subtitle: subtitle, name: '', quantity: '' }];
	}
 
     const removeIngredient = () => {
		ingredients = [...ingredients];
		ingredients.splice(ingredients.length - 1, 1);
	};

</script>

<div class="allIngredientsContainer">
	<div class="subtitleContainer">
		<input
			name="recipe[subtitle][{index}][name]"
			type="text"
			class="ingredientsSubtitle"
			value={subtitle}
		/>
		<Button onClick={addIngredient}>Add ingredient</Button>
		<Button onClick={removeIngredient}>Remove last ingredient</Button>
	</div>
	<!--  make a component out of this (ingredientslist in there) -->
	<div class="ingredientsContainer">
		{#each ingredients as container, ingredientIndex}
				<IngredientInput
					ingredient_subtitle={subtitle}
					bind:ingredient_name={container.name}
					bind:ingredient_quantity={container.quantity}
					subtitleIndex={index}
					ingredientID={container.Id}
				/>
		{/each}
	</div>
</div>

<style>
    .allIngredientsContainer {
		display: flex;
		flex-direction: column;
		gap: 1rem;
		width: 100%;
		margin-top: 1rem;
	}

	.subtitleContainer {
		display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
	}

    .subtitleContainer input{
        width: 300%;
        font-size: 150%;
    }

    .ingredientsContainer {
		display: flex;
		flex-direction: column;
		gap: 1rem;
		width: 100%;
	}

    input {
		width: 80%;
		height: 3rem;
		border-radius: .5rem;
		border: 1px solid;
		padding-left: 1rem;
	}
</style>
