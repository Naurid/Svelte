<script>
	import { apiUrl } from '../../Constants';
	import { sendXHR } from '../../utils/requester';
	import Button from '../Button.svelte';
	import IngredientsContainer from './IngredientsContainer.svelte';
	import StepsForm from './StepsForm.svelte';
	import TitleForm from './TitleForm.svelte';

	/**
	 * @type {any}
	 */
	export let recipe = null;

	let recipeTitle = recipe?.name ?? '';
	/**
	 * @type {any[]}
	 */
	export let ingredientsSubtitles = [];

	/**
	 * @type {any[]}
	 */
	let stepscontainers = recipe?.steps ?? [];

	/**
	 * @type {any}
	 */
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

	const removeIngredientsField = () => {
		ingredientsSubtitles = [...ingredientsSubtitles];
		ingredientsSubtitles.splice(ingredientsSubtitles.length - 1, 1);
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

		const request = await sendXHR(recipe == null ? '/create-recipe' : '/edit-recipe', {}, event);
	}

	// State to hold the YouTube URL and video ID
	let youtubeUrl = recipe?.video_url ?? '';
	let videoId = recipe?.video_url? extractVideoId(recipe?.video_url): '';

	// Function to extract video ID from the YouTube URL
	/**
	 * @param {any} url
	 */
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
	<input name="recipeID" class="hiddenID" value={recipe?.id}/>
	<div class="titleContainer">
		<TitleForm bind:recipeTitle />
		<input
			name="recipePicture"
			type="file"
			accept="image/png, image/jpg, image/jpeg"
			id="upload-photo"
			bind:value={imageURL}
			on:change={handleImageChange}
		/>
		<label style="background-image: url({`${imageURL}` == ''
								? `${apiUrl}${recipe?.image_path}`
								: `${imageURL}`});" for="upload-photo"
			>{`${apiUrl}${recipe?.image_path}` || `${imageURL}` ? '' : 'Browse...'}</label
		>
		
	</div>
	<!--  make a component out of this (ingredientslist and ingredientssubtitles in there) -->
	{#each ingredientsSubtitles as subtitle, index}
		<IngredientsContainer
			{index}
			{subtitle}
			ingredients={recipe?.ingredients.filter(
				(/** @type {{ subtitle: any; }} */ ingredient) => ingredient.subtitle === subtitle
			)}
		/>
	{/each}
	<div class="buttonContainer">
		<Button type="button" onClick={addIngredientsField}>Add ingredients sublist</Button>
		<Button type="button" onClick={removeIngredientsField}>Remove last ingredients sublist</Button>
	</div>
	<div class="container">
		{#each stepscontainers as container, index}
			<StepsForm bind:content={container.steps_description} stepIndex={index} stepId={container.Id} />
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
		<Button type="submit" tabindex="-1">{recipe ?  'Save Changes': 'Create Recipe'}</Button>
	</div>
</form>

<style>
	.hiddenID{
		display: none;
	}
	form {
		width: 100%;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		gap: 1rem;
		background-color: var(--white);
		margin-top: 5%;
		padding: 25px 25px;
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
		width: 100%;
		height: 30rem;
		gap: 1rem;
	}

	label {
		width: 50%;
		height: 500%;
		cursor: pointer;
		background-size: contain; /* Keeps the image's aspect ratio */
		background-repeat: no-repeat; /* Prevents tiling */
		background-position: center; /* Centers the image in the label */
	}

	.videoInput {
		display: flex;
		width: 100%;
		height: 25rem;
		flex-direction: column;
		align-items: center;
		gap: 1rem;
	}

	.videoInput input {
		width: 40%;
	}

	.videoInput iframe {
		width: 40%;
		height: 700%;
	}
	.videoInput p {
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
		border: 1px solid var(--black);
		background-color: transparent;
		padding-left: 1rem;
		text-align: center;
		color: var(--black);
		font-size: 100%;
	}
</style>
