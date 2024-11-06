<script>
	import { onMount } from 'svelte';
	import { sendXHR } from '../utils/requester';
	import RecipeDisplay from './RecipeDisplay.svelte';
	import { apiUrl } from '../Constants';

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

	const displayRecipe = (/** @type {any} */ recipe) => {
		currentRecipe = recipe;
		showRecipe = true;
	};

	let showRecipe = false;

	/**
	 * @type {any}
	 */
	let currentRecipe;

	const closeRecipe = () => {
		showRecipe = false;
	};
</script>

<div class="mainBody">
	{#each recipes as recipe}
		<button
			class="recipeCard"
			on:click={() => {
				displayRecipe(recipe);
			}}
		>
			<img src="{apiUrl}{recipe.image_path}" alt={recipe.name} />

			<div class="info">{recipe.name}</div>
		</button>
		<RecipeDisplay {recipe} bind:showRecipe onClose={closeRecipe} />
	{/each}
</div>

<style>
	.mainBody {
		width: 95%;
		height: 100%;
		display: flex;
		justify-content: flex-start;
		align-items: flex-start;
		margin-top: 5rem;
		gap: 2%;
		padding: 2% 2%;
	}
	.recipeCard {
		position: relative;
		width: 12%;
		border: none;
		padding: 0;
		cursor: pointer;
	}
	button:hover .info {
		height: 100%;
	}

	button img {
		display: block;
		width: 100%;
		object-fit: cover;
	}

	.info {
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		background: rgba(0, 0, 0, 0.7);
		color: #fff;
		overflow: hidden;
		width: 100%;
		height: 0;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		font-size: 3rem;
		transition: 0.5s ease;
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
