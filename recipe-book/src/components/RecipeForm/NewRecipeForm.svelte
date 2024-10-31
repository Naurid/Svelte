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

	const handleImageChange = (/** @type {{ target: { files: any[]; }; }} */ event) => {
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
	};

	const addIngredientsField = () => {
		ingredientsSubtitles = [
			...ingredientsSubtitles,
			{ subtitle: 'subtitle' + ingredientsSubtitles.length }
		];
		console.log('oi');
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
		console.log('submit');

		const request = await sendXHR('/create-recipe', {}, event);
	}

	// State to hold the YouTube URL and video ID
	let youtubeUrl = '';
	let videoId = '';

	// Function to extract video ID from the YouTube URL
	function extractVideoId(url) {
		const regex =
			/(?:https?:\/\/)?(?:www\.)?youtu(?:be\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|\.be\/)([a-zA-Z0-9_-]{11})/;
		const match = url.match(regex);
		return match ? match[1] : null;
	}

	// Update videoId whenever the URL changes
	function handleUrlChange() {
		videoId = extractVideoId(youtubeUrl);
	}
</script>

<form on:submit|preventDefault={handleSubmit}>
	<div class="titleContainer">
		<input
			name="recipePicture"
			type="file"
			accept="image/png, image/jpg, image/jpeg"
			id="upload-photo"
			bind:value={imageURL}
			on:change={handleImageChange}
		/>
		<label style="background-image: url({imageURL});" for="upload-photo">{imageURL? '' : 'Browse...'}</label>
		<TitleForm bind:recipeTitle />
		
		
	</div>
	<!--  make a component out of this (ingredientslist and ingredientssubtitles in there) -->
	{#each ingredientsSubtitles as subtitle, index}
		<IngredientsContainer {index} {subtitle} />
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
	<div class="videoInput">
		<input
			name="recipe[videoURL]"
			type="text"
			bind:value={youtubeUrl}
			placeholder="Enter YouTube URL"
			on:input={handleUrlChange}
		/>
		{#if videoId}
			<iframe
				width="560"
				height="315"
				src={`https://www.youtube.com/embed/${videoId}`}
				title="YouTube video player"
				frameborder="0"
				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
				allowfullscreen
			></iframe>
		{:else}
			<p>Please enter a valid YouTube URL</p>
		{/if}
	</div>
	<div class="submitContainer">
		<Button type="submit" tabindex="-1">Create Recipe</Button>
	</div>
</form>

<style>
	form {
		width: 75%;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		gap: 1rem;
		background-color: var(--form-bg);
		margin-top: 5%;
		padding: 25px;
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

	.titleContainer {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		gap: 1rem;
		width: 100%;
		height: 100%;
	}

	label {
		display: flex;
		align-items: center;
		justify-content: center;
		cursor: pointer;
		color: var(--white);
		width: 50%;
		height: 15rem;
		border: 1px solid;
		background-size: cover;
		background-position: center;
	}

	.videoInput{
		width: 100%;
		height: 30rem;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: space-evenly;
		gap: 1rem;
		padding: 25px 25px;
	}

	.videoInput input{
		width: 30%;
		height: 100%;
	}

	.videoInput iframe{
		width: 40%;
		height: 700%;
	}
	.videoInput p{
		width: 40%;
		height: 700%;
	}

	#upload-photo {
		opacity: 0;
		position: absolute;
		z-index: -1;
	}
	.buttonContainer {
		width: 100%;
		display: flex;
		justify-content: center;
		gap: 5%;
		margin-top: 1rem;
	}

	.submitContainer {
		width: 60%;
		display: flex;
		justify-content: center;
		gap: 5%;
		margin-top: 3rem;
	}

	input {
		width: 80%;
		height: 5rem;
		border: 1px solid var(--white);
		background-color: transparent;
		padding-left: 1rem;
		text-align: center;
		color: var(--white);
		font-size: 100%;
	}
</style>
