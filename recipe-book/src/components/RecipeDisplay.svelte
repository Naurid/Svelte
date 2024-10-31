<script>
	export let recipe;

	export let showRecipe = false;

	export let onClose = () => {};

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

	let videoId = extractVideoId(recipe.video_url);

	function extractVideoId(url) {
		const regex =
			/(?:https?:\/\/)?(?:www\.)?youtu(?:be\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|\.be\/)([a-zA-Z0-9_-]{11})/;
		const match = url.match(regex);
		return match ? match[1] : null;
	}
</script>

<!-- {#if showRecipe}
		<div class="recipe" on:click={onClose}>
			<div class="container" on:click|stopPropagation>
				<button class="closebutton" on:click={onClose}>X</button>
				<h1>{recipe.name}</h1>
				<p>Some random text here</p>
			</div>
		</div>
	{/if} -->

{#if showRecipe}
	<!-- Use role="dialog" and aria-modal="true" for accessibility -->
	<!-- svelte-ignore a11y-click-events-have-key-events -->
	<!-- svelte-ignore a11y-no-static-element-interactions -->
	<div class="overlay" on:click={onClose}>
		<!-- svelte-ignore a11y-no-static-element-interactions -->
		<div class="recipeBody" on:click|stopPropagation>
			<button class="close-button" on:click={onClose} type="button">x</button>
			<h1 class="recipeTitle">{recipe.name}</h1>
			{#if videoId}
				<div class="videoContainer">
					<iframe
						width="560"
						height="315"
						src={`https://www.youtube.com/embed/${videoId}`}
						title="YouTube video player"
						frameborder="0"
						allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
						allowfullscreen
					></iframe>
				</div>
			{/if}
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
		</div>
	</div>
{/if}

<style>
	.overlay {
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background: rgba(0, 0, 0, 0.5);
		display: flex;
		justify-content: center;
		align-items: center;
		z-index: 1000;
		outline: none; /* To remove focus outline on click, keep this if not needed */
		margin-top: 5rem;
	}
	.recipeBody {
		max-height: 95%;
    	overflow-y: auto; 
		background: var(--white);
		width: 60%;
		padding: 20px;
		box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
		margin-top: 1rem;
	}
	.close-button {
		margin-top: 10px;
	}

	.ingredientsContainer {
		display: flex;
		flex-direction: column;
		gap: 0.5rem;
		padding: 10px 10px;
		background-color: var(--ingredient-container-color);
		box-shadow: 0 0 10px var(--box-shadow-color);
		width: 97%;
		border-radius: 0.5rem;
	}

	.ingredientSublist {
		background-color: var(--ingredient-sublist-container-color);
		box-shadow: 0 0 10px var(--black);
		width: 50%;
		display: flex;
		flex-direction: column;
        padding-left: 1rem;
	}
	.ingredientContainer {
		display: flex;
		width: 100%;
		gap: 1rem;
	}

	.recipeTitle {
		text-align: center;
	}

	h2 {
		text-decoration: underline solid var(--black) 1px;
	}
	.videoContainer {
		display: flex;
        justify-content: center;
	}
</style>
