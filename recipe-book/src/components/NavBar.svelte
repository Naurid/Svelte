<div class="navBody">
	<h1>New Recipe</h1>
	<a href="/recettes"><h1>All Recipes</h1></a>
</div>

<style>
	@import '../main_style.css';
	h1 {
		font-size: 2.5rem;
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
		color: var(--navbar-text-color);
		margin-right: auto;
		padding-left: 25px;
		padding-right: 25px;
	}
	
	.navBody a{
		text-decoration: none;
	}

	.navBody {
		display: inline-flex;
		justify-content: center;
		align-items: center;
        position: fixed;
        top: 0;
        left: 0;
		background-color: var(--navbar-background-color);
		box-shadow: 0 0 25px var(--navbar-background-color);
		width: 100vw;
		height: 7%;
		z-index: 1;
		backdrop-filter: blur(5px);
		-webkit-backdrop-filter: blur(5px);
		border: 1px solid var(--navbar-background-color);
	}
</style>
