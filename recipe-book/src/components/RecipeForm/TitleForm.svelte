<script>
    export let recipeTitle = '';
</script>

<div class="titleContainer">
	<input name='recipe[title]' type="text" placeholder="Type the name of your recipe here" bind:value={recipeTitle}/>
</div>

<style>
    .titleContainer{
        width: 100%;
		height: 5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
		margin-bottom: 2rem;
    }

	input {
		width: 80%;
		height: 100%;
		border-radius: .5rem;
		border: 1px solid;
		padding-left: 1rem;
		text-align: center;
		font-size: 200%;
		font-family:
			system-ui,
			-apple-system,
			BlinkMacSystemFont,
			'Segoe UI',
			Roboto,
			Oxygen,
			Ubuntu,
			Cantarell,
			'Open Sans',
			'Helvetica Neue',
			sans-serif;
	}
	
</style>
