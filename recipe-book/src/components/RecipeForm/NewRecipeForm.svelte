<script>
	import { sendXHR } from '../../utils/requester';
	import Button from '../Button.svelte';
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

	let imageURL = '';

	const handleImageChange =(/** @type {{ target: { files: any[]; }; }} */ event)=>{
		const file = event.target.files[0];
		
		if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();
      reader.onload = () => {
        imageURL = reader.result; // Update the imageUrl with the base64 data URL
      };
      reader.readAsDataURL(file);
    } else {
      alert('Please select a valid image file.');
    }
	}

	const addIngredientsField = () => {
		ingredientsSubtitles = [
			...ingredientsSubtitles,
			{ subtitle: 'subtitle' + ingredientsSubtitles.length }
		];
		console.log("oi");
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
		console.log("submit");

		const request = await sendXHR('/create-recipe', {}, event);
	}
</script>

<form on:submit|preventDefault={handleSubmit}>
	<div class="titleContainer">
		<TitleForm bind:recipeTitle={recipeTitle} />
		<label style="background-image: url({imageURL});" for="upload-photo">Browse...</label>
		<input name="recipePicture" type="file" accept="image/png, image/jpg, image/jpeg" id="upload-photo" bind:value={imageURL} on:change={handleImageChange}/>
	</div>
	<!--  make a component out of this (ingredientslist and ingredientssubtitles in there) -->
	{#each ingredientsSubtitles as subtitle, index}
		<IngredientsContainer
			{index}
			{subtitle}
		/>
	{/each}
	<div class="buttonContainer">
		<Button type="button" onClick={addIngredientsField}>Add ingredients sublist</Button>
		<Button type="button" onClick={removeIngredientsField}>Remove last ingredients sublist</Button>
	</div>
	<div class="container">
		{#each stepscontainers as container, index}
			<StepsForm bind:title={container.title} bind:content={container.content} stepIndex={index} />
		{/each}
	</div>
	<div class="buttonContainer">
		<Button type="button" onClick={addStepsField}>Add step</Button>
		<Button type="button" onClick={removeStepsField}>Remove step</Button>
	</div>	
	<div class="submitContainer">
		<Button type="submit" tabindex="-1">Create Recipe</Button>
	</div>	
	
</form>

<style>

	form {
		width: 50%;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		gap: 2%;
		background-color: var(--main-container-color);
		margin-top: 5%;
		padding: 25px;

		border-radius: 16px;
		box-shadow: 0 4px 30px var(--box-shadow-color);
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

	.titleContainer{
		display: flex;
		width: 100%;
	}

	label{
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		background-color: var(--neutral-white);
		color: rgb(60, 59, 59);
		width: 50%;
		height: 5rem;
		border-radius: 0.5rem;
		border: 1px solid;
		background-size: cover;
		background-position: center;
	}
	#upload-photo{
		opacity: 0;
		position: absolute;
		z-index: -1;
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
