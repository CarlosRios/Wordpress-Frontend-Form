<?php
namespace WPFF\Admin;

class Settings {

	private $_postid;

	/**
	 * Sets the id, and returns form
	 * @return formHtml()
	 */
	public function __construct(){
		$this->_postid = get_the_ID();
		$this->formHtml();
	}

	/**
	 * echo the form html
	 */
	private function formHtml()
	{?>
		<div class="wpff-use-shortcode">
			<h2>To use this form simply use the shortcode: <span>[wpff id="<?php echo $this->_postid; ?>"]</span></h2>
		</div>
		<table class="widefat">
			<tbody>
				<tr>
					<td class="wpff-padding-20">
						<?php $this->getSettings(); ?>
					</td>
				</tr>
			</tbody>
		</table>
	<?php
	}

	/**
	 * Returns the sidebar form for admin form
	 */
	private function getSettings()
	{
		// Gather post types in array
		$post_types = get_post_types(['public' => true], 'objects');
		$types = [];
		foreach($post_types as $type){
			$types[$type->name] = $type->labels->name;
		}

		// Gather status' in array
		$stati = get_post_stati();

		// Gather authors
		$authors = ['' => 'Choose An Author'];
		$users = get_users();
		foreach($users as $user){
			$authors[$user->ID] = $user->display_name;
		}

		// Set default options to prevent errors
		if( ! $options = get_post_meta($this->_postid, 'wpff_options', true) )
			$options = ['button' => ['class' => '', 'text' => 'Submit'], 'post_type' => 'posts'];
		?>
		<div class="wpff-form">
			<div class="row">
				<div class="six columns">
					<div class="row">
						<div class="six columns">
							<?php
							$fields = [
								Input::select('wpff-form-options-post-type', 'wpff_options[post_type]', 'Post type to save to', $options['post_type'], $types ),
								Input::select('wpff-form-options-post-status', 'wpff_options[post_status]', 'New Post Status', $options['post_status'], $stati, 'The status the new post will receive.' )
							];
							echo Input::createSettingsBlock('Post Type', '', 'dashicons-admin-post', $fields);
							?>
						</div>
						<div class="six columns">
							<?php
							$fields = [
								Input::text('wpff-form-options-button-class', 'wpff_options[button][class]', 'Submit Button Class', $options['button']['class']),
								Input::text('wpff-form-options-button-text', 'wpff_options[button][text]', 'Submit Button Text', valueOrDefault($options['button']['text'], 'Submit') )
							];
							echo Input::createSettingsBlock('Button Settings', '', 'dashicons-admin-appearance', $fields);
						?>
						</div>
					</div>
					<div class="row">
						<div class="six columns">
							<?php
							$fields = [
								/*Input::checkbox('wpff-form-options-apply-styles', 'wpff_options[apply_styles]', 'Apply WordPress Frontend Form Styles?', 1, $options['apply_styles'], 'If checked, it will apply the wpff styles to your form.'),*/
								Input::checkbox('wpff-form-options-labels', 'wpff_options[labels]', 'Show Field Labels?', 1, $options['labels'])
							];
							echo Input::createSettingsBlock('Display Settings', '', 'dashicons-format-aside', $fields);
							?>
						</div>
						<div class="six columns">
							<?php
							$fields = [
								Input::select('wpff-form-options-author', 'wpff_options[author]', 'Assign an author', $options['author'], $authors, 'Assign these posts to an author.')
							];
							echo Input::createSettingsBlock('Author Settings', '', 'dashicons-admin-users', $fields);
							?>
						</div>
					</div>
				</div>

				<div class="six columns">
					<?php
					$fields = [
						Input::text('wpff-form-options-message-success', 'wpff_options[message][success]', 'Success Message', $options['message']['success'], false, 'The message a user sees when their submission is successful.'),
						Input::text('wpff-form-options-message-error', 'wpff_options[message][error]', 'Error Message', $options['message']['error'], false, 'The message a user sees when their submission has errors.')
					];
					echo Input::createSettingsBlock('User Notifications', '', 'dashicons-megaphone', $fields);
					?>

					<?php
					$fields = array(
						Input::checkbox('wpff-form-options-email_on', 'wpff_options[email_on]', 'Turn on email notifications', 1, $options['email_on']),
						Input::text('wpff-form-options-email-to', 'wpff_options[email][to]', 'Send To Email', $options['email']['to'], 'johndoe@gmail.com', 'This is the person who will receive the notification'),
					);
					echo Input::createSettingsBlock('Email Settings', 'Setup email settings for this form.', 'dashicons-email-alt', $fields);
					?>
				</div>
			</div>
		</div>
	<?php
	}

}