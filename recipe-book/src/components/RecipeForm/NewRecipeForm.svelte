<script>
	import { sendXHR } from '../../utils/requester';
	import Button from '../Button.svelte';
	import IngredientInput from './IngredientInput.svelte';
	import IngredientsContainer from './IngredientsContainer.svelte';
	import StepsForm from './StepsForm.svelte';
	import TitleForm from './TitleForm.svelte';

	let recipeTitle = '';
	/**
	 * @type {any[]}
	 */
	let ingredientsSubtitles = [];

	/**
	 * @type {any[]}
	 */
	let ingredients = [];

	/**
	 * @type {any[]}
	 */
	let stepscontainers = [];

	const addIngredientsField = () => {
		ingredientsSubtitles = [
			...ingredientsSubtitles,
			{ subtitle: 'subtitle' + ingredientsSubtitles.length }
		];
	};

	/**
	 * @param {{ detail: { text: any; }; }} event
	 */
	function addIngredient(event) {
		let subtitle = event.detail.text.subtitle;
		ingredients = [...ingredients, { subtitle: subtitle, name: '', quantity: '' }];
	}

	const removeIngredientsField = () => {
		ingredientsSubtitles = [...ingredientsSubtitles];
		ingredientsSubtitles.splice(ingredientsSubtitles.length - 1, 1);
	};

	const removeIngredient = () => {
		ingredients = [...ingredients];
		ingredients.splice(ingredients.length - 1, 1);
	};

	const addStepsField = () => {
		stepscontainers = [...stepscontainers, { title: '', content: '' }];
	};

	const removeStepsField = () => {
		stepscontainers = [...stepscontainers];
		stepscontainers.splice(stepscontainers.length - 1, 1);
	};

	/**
	 * @param {any} event
	 */
	async function handleSubmit(event) {
		console.log(event.target.closest('form'));

		const request = await sendXHR('/create-recipe', {}, event);
	}
</script>

<form on:submit|preventDefault={handleSubmit}>
	<TitleForm bind:title={recipeTitle} />
	<!--  make a component out of this (ingredientslist and ingredientssubtitles in there) -->
	{#each ingredientsSubtitles as subtitle, index}
		<IngredientsContainer
			{index}
			{subtitle}
		/>
	{/each}
	<div class="buttonContainer">
		<Button type="button" on:click={addIngredientsField}>Add ingredients sublist</Button>
		<Button type="button" on:click={removeIngredientsField}>Remove last ingredients sublist</Button>
	</div>
	<div class="container">
		{#each stepscontainers as container, index}
			<StepsForm bind:title={container.title} bind:content={container.content} stepIndex={index} />
		{/each}
	</div>
	<div class="buttonContainer">
		<Button type="button" on:click={addStepsField}>Add step</Button>
		<Button type="button" on:click={removeStepsField}>Remove step</Button>
	</div>	
	<div class="submitContainer">
		<Button type="submit" tabindex="-1">Create Recipe</Button>
	</div>	
	
</form>

<style>
	@import '../../main_style.css';

	form {
		width: 50%;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		gap: 2%;
		background-color: var(--form-background-color);
		margin-top: 5%;
		padding: 25px;

		border-radius: 16px;
		box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
		backdrop-filter: blur(5px);
		-webkit-backdrop-filter: blur(5px);
		border: 1px solid rgba(255, 255, 255, 0.3);
	}

	.container {
		display: flex;
		flex-direction: column;
		gap: 1rem;
		width: 100%;
		margin-top: 2rem;
	}

	.buttonContainer{
		width: 100%;
		display: flex;
		justify-content: center;
		gap: 5%;
		margin-top: 1rem;
	}

	.submitContainer{
		width: 60%;
		display: flex;
		justify-content: center;
		gap: 5%;
		margin-top: 3rem;
	}
</style>
