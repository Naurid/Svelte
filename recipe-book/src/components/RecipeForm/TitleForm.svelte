<script>
    export let recipeTitle = '';
</script>

<div class="titleContainer">
	<input name='recipe[title]' type="text" placeholder="Type the name of your recipe here" bind:value={recipeTitle}/>
</div>

<style>
    .titleContainer{
        width: 100%;
		height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
		margin-bottom: 2rem;
    }

	input {
		width: 60%;
		height: 100%;
		font-size: 2.5rem;
		font-weight: 500;
		text-align: center;
	}
	
</style>
