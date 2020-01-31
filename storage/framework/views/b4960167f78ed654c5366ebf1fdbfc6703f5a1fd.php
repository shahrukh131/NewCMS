<?php $__env->startSection('content'); ?>

<div class="d-flex justify-content-end mb-2">
<a href="<?php echo e(route('posts.create')); ?>" class="btn btn-success">Add Post</a>

</div>
<div class="card card-default">
    <div class="card card-header">
        Posts
    </div>

    <div class="card card-body">
       <?php if($posts->count()>0): ?>
        <table class="table">
            <thead>
                <th>image</th>
                <th>title</th>
                <th>Catagory</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                    <img src="<?php echo e(($post->image)); ?>" alt="<?php echo e($post->Title); ?>" width="220px" height="120px">
                    </td>
                    <td>
                        <?php echo e($post->Title); ?>


                    </td>

                    <td>
                        <a href=""><?php echo e($post->catagory->name); ?></a>
                    </td>

                    <?php if($post->trashed()): ?>

                    <td>
                        <form action="<?php echo e(route('restore-posts',$post->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <button type = 'submit'class="btn btn-info btn-sm">Restore</button>
                        </form>

                    </td>
                    <?php else: ?>
                     <td>
                        <a href="<?php echo e(route('posts.edit',$post->id)); ?>" class="btn btn-info btn-sm">Edit</a>

                    </td>



                    <?php endif; ?>
                    <td>
                    <form action="<?php echo e(route('posts.destroy',$post->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                         <button class="btn btn-danger btn-sm">
                             <?php echo e($post->trashed()?'Delete':'Trash'); ?>

                         </button>
                    </form>
                    </td>


                </tr>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </tbody>


        </table>

       <?php else: ?>

       <h3 class="text-center">No posts available</h3>


       <?php endif; ?>

    </div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\xampp\htdocs\Laravel\cms2\resources\views/posts/index.blade.php ENDPATH**/ ?>