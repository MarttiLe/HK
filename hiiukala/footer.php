		</main>

		<!-- Site footer -->
		<?php
			$contacts = get_field('contacts', 'options');
			$company = get_field('company', 'options');
		?>
		<footer class="footer">
			<div class="footer__container container">

				<div class="separator separator--wave">&nbsp;</div>

				<ul class="footer-info">
					<?php if(!empty($company['name'])) : ?>
					<li class="footer-info__item">
						&copy; <?php echo $company['name']; ?> <?php echo date('Y'); ?>
					</li>
					<?php endif; ?>

					<?php if(!empty($contacts['phone'])) : ?>
					<li class="footer-info__item">
						<a href="tel:<?php echo theme_get_formatted_tel($contacts['phone']); ?>" class="footer__anchor"><?php echo $contacts['phone']; ?></a>
					</li>
					<?php endif; ?>

					<?php if(!empty($contacts['email'])) : ?>
					<li class="footer-info__item">
						<a href="mailto:<?php echo antispambot($contacts['email']); ?>" class="footer__anchor"><?php echo antispambot($contacts['email']); ?></a>
					</li>
					<?php endif; ?>

					<?php if(!empty($contacts['address'])) : ?>
					<li class="footer-info__item">
						<?php if(!empty($contacts['address_google_maps'])) : ?>
						<a href="<?php echo $contacts['address_google_maps']; ?>" target="_blank" rel="noopener" class="footer__anchor"><?php echo $contacts['address']; ?></a>
						<?php else : ?>
						<?php echo $contacts['address']; ?>
						<?php endif; ?>
					</li>
					<?php endif; ?>
				</ul>
				
			</div>
		</footer>

		<!-- WP footer -->
		<?php wp_footer(); ?>

	</body>

</html>