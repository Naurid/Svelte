<script>
	import NavBar from '../components/NavBar.svelte';
	import Form from '../components/RecipeForm/NewRecipeForm.svelte';
</script>

<div class="mainBody">
	<NavBar />
	<div class="container">
	<Form/>
</div>
</div>

<style>

	.mainBody{
		display: flex;
		justify-content: center;
		align-items: center;
		height: auto; /* Ensure height is not fixed */
		overflow: auto; /* Allow page scrolling */
		padding-top: 1rem;
		padding-bottom: 5rem;
	}
	.container{
		width: 75%;
	}
</style>
