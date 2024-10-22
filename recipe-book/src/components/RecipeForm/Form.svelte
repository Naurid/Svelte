<script>
	import IngredientsForm from './IngredientsForm.svelte';
	import StepsForm from './StepsForm.svelte';
	import TitleForm from './TitleForm.svelte';
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
		ingredientsSubtitles = [...ingredientsSubtitles, {subtitle :'subtitle' + ingredientsSubtitles.length}];
	}

	const addIngredient = (/** @type {string} */ subtitle) => {
		ingredients = [
			...ingredients,
			{ subtitle: subtitle, name: '', quantity: '' }
		];
	};

	const removeIngredientsField = () => {
		ingredientsSubtitles = [...ingredientsSubtitles];
		ingredientsSubtitles.splice(ingredientsSubtitles.length - 1, 1);
	}

	const removeIngredient = () => {
		ingredients = [...ingredients];
		ingredients.splice(ingredients.length - 1, 1);
	};

	const addStepsField = () => {
		stepscontainers = [...stepscontainers, { title: '', content: '' }];
	};

	const removeStepsField = () =>{
		stepscontainers = [...stepscontainers];
		stepscontainers.splice(stepscontainers.length - 1, 1);
	}
</script>

<div class="formContainer">
	<TitleForm title="Recipe Name" />
	<!--  make a component out of this (ingredientslist and ingredientssubtitles in there) -->
	{#each ingredientsSubtitles as subtitle}
		<div class="allIngredientsContainer">
			<div class="subtitleContainer">
				<input type="text" class="ingredientsSubtitle" bind:value={subtitle.subtitle} />
				<button on:click={() => {addIngredient(subtitle.subtitle);}}>+I</button>
				<button on:click={removeIngredient}>-I</button>
			</div>
			<!--  make a component out of this (ingredientslist in there) -->
			<div class="ingredientsContainer">
				{#each ingredients as container}
					{#if container.subtitle === subtitle.subtitle}
					<IngredientsForm
						bind:ingredient_subtitle={subtitle.subtitle}
						bind:ingredient_name={container.name}
						bind:ingredient_quantity={container.quantity}
					/>
					{/if}
				{/each}
			</div>
		</div>
	{/each}
	<button on:click={addIngredientsField}>+F</button>
	<button on:click={removeIngredientsField}>-F</button>
	<div class="ingredientsContainer">
		{#each stepscontainers as container}
			<StepsForm bind:title={container.title} bind:content={container.content} />
		{/each}
	</div>
	<button on:click={addStepsField}>+</button>
	<button on:click={removeStepsField}>-</button>
</div>

<style>
	.formContainer {
		width: 50%;
		height: auto;
		display: flex;
		flex-direction: column;
		justify-content: start;
		align-items: flex-end;
		gap: 2%;
		background-color: bisque;
		margin-top: 5%;
		padding: 25px;
	}

	.allIngredientsContainer{
		display: flex;
		flex-direction: column;
		gap: 1rem;
		width: 100%;
		margin-top: 1rem;
	}

	.subtitleContainer{
		display: flex;
		align-items: center;
		justify-content: flex-start;
		gap: 1rem;
	}

	.ingredientsContainer {
		display: flex;
		flex-direction: column;
		gap: 1rem;
		width: 100%;
	}
	button {
		width: 10%;
		height: 3rem;
		background-color: #f2c44f;
		border: none;
		border-radius: 1rem;
		margin-top: 1rem;
		color: black;
		font-size: 1.2rem;
		cursor: pointer;
	}

	button:hover {
		background-color: #e1b045;
	}

	input {
		width: 80%;
		height: 3rem;
		border-radius: 1rem;
		padding-left: 1rem;
	}
</style>
