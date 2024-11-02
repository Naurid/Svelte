<script>
	export let content = '';
	export let stepIndex;
	export let stepId ='';

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
	<textarea
		on:input={textAreaAdjust}
		name="recipe[steps][{stepIndex}][content]"
		class="stepContent"
		bind:value={content}
		placeholder="Type the content of the step here"
	/>
	<input name="recipe[steps][{stepIndex}][Id]" type="hidden" value={stepId}/>
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

	.stepContent {
		width: 95%;
		height: 6rem;
		overflow: hidden;
		border-radius: 0.5rem;
		border: 1px solid;
		padding: 15px;
	}
</style>
