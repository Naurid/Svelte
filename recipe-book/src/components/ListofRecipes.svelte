<script>
	import { onMount } from 'svelte';
	import { sendXHR } from '../utils/requester';

	/**
	 * @type {any[]}
	 */
	let recipes = [];

	let debug;
	let parsedData;

	onMount(async () => {
		try {
			debug = await sendXHR('/get-recipes');
			//console.log(debug);
			parsedData = JSON.parse(debug);
			recipes = parsedData['data']; // Afficher la réponse dans la console
		} catch (error) {
			console.error(error); // Gérer les erreurs
		}
	});

	/**
	 * @type {any}
	 */
	let currentSubtitle;

	/**
	 * @param {any[]} ingredients
	 */
	function getUniqueSubtitles(ingredients) {
		/**
		 * @type {any[]}
		 */
		const uniqueSubtitles = [];
		ingredients.forEach((/** @type {{ subtitle: any; }} */ ingredient) => {
			if (
				uniqueSubtitles.length === 0 ||
				uniqueSubtitles[uniqueSubtitles.length - 1] !== ingredient.subtitle
			) {
				uniqueSubtitles.push(ingredient.subtitle);
			}
		});
		return uniqueSubtitles;
	}

	const displayRecipe = (recipe) => {
		currentRecipeTitle = recipe.name;
		showRecipe = true;
	};

	let showRecipe = false;

	let currentRecipeTitle = '';
</script>

<div class="mainBody">
	{#each recipes as recipe}
		<div class="recipeCard">
			<button
				on:click={() => {
					displayRecipe(recipe);
				}}>{recipe.name}</button
			>
		</div>
	{/each}
{#if showRecipe}
	
<div class="recipe">
	<h1>{currentRecipeTitle}</h1>
</div>
{/if}
</div>

<!-- <div class="recipeBody">
			<h1>{recipe.name}</h1>
			<h2>Ingredients</h2>
			<div class="ingredientsContainer">
				{#each getUniqueSubtitles(recipe.ingredients) as subtitle}
					<div class="ingredientSublist">
						<h3>{subtitle}</h3>
						{#each recipe.ingredients.filter((/** @type {{ subtitle: any; }} */ ingredient) => ingredient.subtitle === subtitle) as ingredient}
							<div class="ingredientContainer">
								<p>{ingredient.name}</p>
								<p>{ingredient.quantity} g</p>
							</div>
						{/each}
					</div>
				{/each}
			</div>
			<h2>Preparation</h2>
			<div class="stepsContainer">
				{#each recipe['steps'] as step}
					<div class="stepContainer">
						<h3>{step.step_position}. {step.steps_title}</h3>
						<p>{step.steps_description}</p>
					</div>
				{/each}
			</div>
		</div> -->

<style>
	.mainBody {
		width: 95vw;
		display: flex;
		justify-content: flex-start;
		align-items: flex-start;
		gap: 5%;
		margin-top: 5%;
	}
	.recipeCard {
		width: 800px;
		height: 600px;
	}
	button {
		width: 100%;
		height: 100%;
	}
	.recipe {
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: rgb(255, 255, 255);
		display: flex;
		justify-content: center;
		align-items: center;
		z-index: 1000;
	}
	/* 
	h1 {
		color: var(--white);
	}
	h2{
		color: var(--white);
		padding-left: 2rem;
		text-decoration: solid underline var(--recipe-text-color);
		align-self: flex-start;
	}

	

	.recipeBody {
		background-color: var(--main-container-color);
		box-shadow: 0 0 10px var(--box-shadow-color);
        border-radius: .5rem;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
        gap: 1rem;
        padding: 15px 15px;
	}

    .ingredientsContainer{
        display: flex;
        flex-direction: column;
        gap: .5rem;
        padding: 10px 10px;
        background-color: var(--ingredient-container-color);
		box-shadow: 0 0 10px var(--box-shadow-color);
        width: 97%;
        border-radius: .5rem;
    }

	.ingredientSublist {
        background-color: var(--ingredient-sublist-container-color);
		box-shadow: 0 0 10px var(--box-shadow-color);
		width: 100%;
        display: flex;
        flex-direction: column;
        border-radius: .5rem;
	}
	.ingredientContainer {
		display: flex;
		width: 100%;
	}

    .stepsContainer{
        background-color: var(--steps-container-color);
		box-shadow: 0 0 10px var(--box-shadow-color);
        width: 97%;
        border-radius: .5rem;
        padding: 10px 10px;
    }

    .ingredientContainer,
    .stepContainer,
    h3,
    p{
        padding: 0px 15px;
    }

    h3{
        margin: 0;
        padding-top: 15px;
		color: var(--white);
    }

	p{
		color: var(--white);
	} */
</style>
