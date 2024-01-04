<div class="content" style="width: 100%; font-size: 12px; padding: 5px">
	<div class="title" style="text-align: center; font-size: 13px; padding-bottom: 5px; border-bottom: 1px dashed;">
		<b>MY POS</b>
		<br>
		JL. SEPANJANG JALAN KENANGAN
	</div>

	<div class="head" style="margin-top: 5px; margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td style="width: 200px">
					<?php echo e(date('d-m-Y H:i:s', strtotime($penjualan->created_at))); ?>

				</td>
				<td>Kasir</td>
				<td style="text-align: center; width: 10px;">:</td>
				<td><?php echo e($penjualan->name); ?></td>
			</tr>
			<tr>
				<td><?php echo e($penjualan->no_penjualan); ?></td>
				<td>Pelanggan</td>
				<td style="text-align: center;">:</td>
				<td><?php echo e($penjualan->nama_pelanggan == '' ? "Umum" : $penjualan->nama_pelanggan); ?></td>
			</tr>
		</table>
	</div>

	<div class="transaksi">
		<table cellspacing="0" cellpadding="0" style="width: 100%; font-size: 12px;">
			<?php
			$arr = [];
			?>
			<?php $__currentLoopData = $penjualan_detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td style="width: 165px;"><?php echo e($pd->nama_produk); ?></td>
				<td><?php echo e($pd->qty); ?></td>
				<td style="text-align: right; width: 60px;"><?php echo e('Rp. '.number_format($pd->harga_jual)); ?></td>
				<td style="text-align: center; width: 10px">:</td>
				<td style="text-align: right; width: 100px;"><?php echo e('Rp. '.number_format(($pd->harga_jual - $pd->diskon_produk) * $pd->qty )); ?></td>
			</tr>

			<?php if ($pd->diskon_produk > 0) {
				$arr[] = $pd->diskon_produk;
			} ?>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			<?php $__currentLoopData = $arr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr>
				<td style="width: 165px"></td>
				<td style="text-align: right; width: 60px"></td>
				<td style="text-align: right; width: 10px" colspan="2">Disc. <?php echo e(($a + 1)); ?> :</td>
				<td style="text-align: right; width: 60px"><?php echo e('Rp. '.number_format($value)); ?></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

			<tr>
				<td colspan="5" style="border-bottom: 1px dashed; padding-top: 5px"></td>
			</tr>

			<tr>
				<td colspan="2"></td>
				<td style="text-align: right; padding-top: 5px;">Total</td>
				<td style="text-align: center; padding-top: 5px;">:</td>
				<td style="text-align: right; padding-top: 5px;"><?php echo e('Rp. '.number_format($penjualan->total)); ?></td>
			</tr>

			<?php if($penjualan->diskon > 0): ?>
			<tr>
				<td colspan="2"></td>
				<td style="text-align: right; padding-bottom: 5px">Disc.</td>
				<td style="text-align: right; padding-bottom: 5px">:</td>
				<td style="text-align: right; padding-bottom: 5px"><?php echo e('Rp. '.number_format($penjualan->diskon)); ?></td>
			</tr>
			<?php endif; ?>

			<tr>
				<td colspan="2"></td>
				<td style="border-top: 1px dashed; text-align: right; padding: 5px 0">Subtotal</td>
				<td style="border-top: 1px dashed; text-align: right; padding: 5px 0">:</td>
				<td style="border-top: 1px dashed; text-align: right; padding: 5px 0"><?php echo e('Rp. '.number_format($penjualan->subtotal)); ?></td>
			</tr>

			<tr>
				<td colspan="2"></td>
				<td style="border-top: 1px dashed; text-align: right; padding-top: 5px;">Uang</td>
				<td style="border-top: 1px dashed; text-align: right; padding-top: 5px;">:</td>
				<td style="border-top: 1px dashed; text-align: right; padding-top: 5px;"><?php echo e('Rp. '.number_format($penjualan->uang)); ?></td>
			</tr>

			<tr>
				<td colspan="2"></td>
				<td style="text-align: right; ">Kembali</td>
				<td style="text-align: right; ">:</td>
				<td style="text-align: right; "><?php echo e('Rp. '.number_format($penjualan->kembali)); ?></td>
			</tr>

		</table>
	</div>

	<div class="thanks" style="margin-top: 10px; padding-top: 10px; text-align: center; border-top: 1px dashed;">
		~~~ Terima Kasih ~~~
	</div>
</div><?php /**PATH C:\Users\Hp\Desktop\pos\resources\views/transaksi/penjualan/detail.blade.php ENDPATH**/ ?>