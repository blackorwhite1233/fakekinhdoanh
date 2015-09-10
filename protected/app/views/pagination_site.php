<?php if($paginator->getLastPage() > 1){ ?>
<ul class="pagination">
                        <li class="first-page"><a href="<?php echo $paginator->getUrl(1) ?>">Trang đầu</a></li>
                        <li><a href="<?php echo $paginator->getUrl($paginator->getCurrentPage() - 1) ?>"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
                        <?php for ($i=1; $i <= $paginator->getLastPage(); $i++): ?>
						<?php 
							if($i == $paginator->getCurrentPage())
							{
						?>
								<li class="active"><a href="<?php echo $paginator->getUrl($i) ?>"><?php echo $i ?></a></li>
						<?php
							}else
							{
						?>
							<li><a href="<?php echo $paginator->getUrl($i) ?>"><?php echo $i ?></a></li>
						<?php
							}
						?>	
				    <?php endfor ?>
                        
                        <li><a href="<?php echo $paginator->getUrl($paginator->getCurrentPage() + 1) ?>"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
                        <li class="last-page"><a href="<?php echo $paginator->getLastUrl() ?>">Trang cuối</a></li>
                    </ul>
<?php } ?>
