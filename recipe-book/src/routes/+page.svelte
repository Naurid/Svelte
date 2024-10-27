<script>
	import NavBar from '../components/NavBar.svelte';
	import Form from '../components/RecipeForm/NewRecipeForm.svelte';
</script>

<div class="mainBody">
	<NavBar />
	<Form/>
</div>

<style>

	.mainBody{
		display: flex;
		justify-content: center;
		align-items: center;
		height: auto; /* Ensure height is not fixed */
		overflow: auto; /* Allow page scrolling */
		background-color: var(--bg);
		padding-top: 1rem;
		padding-bottom: 5rem;
	}
</style>
