<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Introduction to Algorithms, 3rd Edition',
            'description' => 'Some books on algorithms are rigorous but incomplete; others cover masses of material but lack rigor. Introduction to Algorithms uniquely combines rigor and comprehensiveness. The book covers a broad range of algorithms in depth, yet makes their design and analysis accessible to all levels of readers. Each chapter is relatively self-contained and can be used as a unit of study. The algorithms are described in English and in a pseudocode designed to be readable by anyone who has done a little programming.',
            'image_url' => 'intro-algo.jpg',
            'price' => 66.32
        ]);

        DB::table('products')->insert([
            'name' => 'Structure and Interpretation of Computer Programs - 2nd Edition',
            'description' => 'Structure and Interpretation of Computer Programs has had a dramatic impact on computer science curricula over the past decade. This long-awaited revision contains changes throughout the text. There are new implementations of most of the major programming systems in the book, including the interpreters and compilers, and the authors have incorporated many small changes that reflect their experience teaching the course at MIT since the first edition was published.',
            'image_url' => 'struct-interpret.jpg',
            'price' => 55.25
        ]);

        DB::table('products')->insert([
            'name' => 'The Pragmatic Programmer: From Journeyman to Master',
            'description' => 'The Pragmatic Programmer cuts through the increasing specialization and technicalities of modern software development to examine the core process--taking a requirement and producing working, maintainable code that delights its users. It covers topics ranging from personal responsibility and career development to architectural techniques for keeping your code flexible and easy to adapt and reuse.',
            'image_url' => 'prag-prog.jpg',
            'price' => 32.59
        ]);
    }
}
