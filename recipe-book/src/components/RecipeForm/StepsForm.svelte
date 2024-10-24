<script>
	export let title = '';
	export let content = '';
	export let stepIndex;

	/**
	 * @param {{ target: any; }} event
	 */
	function textAreaAdjust(event) {
		const textarea = event.target;
		textarea.style.height = 'auto'; // Reset the height to auto to calculate the new height
		textarea.style.height = textarea.scrollHeight + 'px'; // Set height to match the scrollHeight
	}
</script>

<div class="container">
	<input
		name="recipe[steps][{stepIndex}][title]"
		type="text"
		class="stepTitle"
		bind:value={title}
		placeholder="Type the name of the step here"
	/>
	<textarea
		on:input={textAreaAdjust}
		name="recipe[steps][{stepIndex}][content]"
		class="stepContent"
		bind:value={content}
		placeholder="Type the content of the step here"
	/>
</div>

<style>
	.container {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: flex-start;
		gap: 1rem;
		width: 100%;
	}

	.stepTitle {
		width: 75%;
		height: 3rem;
		border-radius: 0.5rem;
		border: 1px solid;
		padding-left: 1rem;
	}

	.stepContent {
		width: 95%;
		height: 6rem;
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
		overflow: hidden;
		border-radius: 0.5rem;
		border: 1px solid;
		padding: 15px;
	}
</style>
