<script>
	import IngredientsForm from './IngredientsForm.svelte';
	import StepsForm from './StepsForm.svelte';
	import TitleForm from './TitleForm.svelte';

	/**
	 * @type {any[]}
	 */
	let ingredientsContainers = [];

    /**
	 * @type {any[]}
	 */
	let stepscontainers = [];

	const addIngredientsField = () => {
        ingredientsContainers = [...ingredientsContainers, {name: '', quantity:'' }]
    };

    const addStepsField = () => {
        stepscontainers = [...stepscontainers, {title: '', content:'' }]
    };
</script>

<div class="formContainer">
	<TitleForm title="Recipe Name" />
	<div class="ingredientsContainer">
		{#each ingredientsContainers as container, index}
			<IngredientsForm bind:ingredient_name={container.name} bind:ingredient_quantity={container.quantity}/>
		{/each}
	</div>
	<button on:click={addIngredientsField}>+</button>
    <div class="ingredientsContainer">
        {#each stepscontainers as container}
            <StepsForm bind:title={container.title} bind:content={container.content}/>
        {/each}
    </div>
    <button on:click={addStepsField}>+</button>
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
</style>
