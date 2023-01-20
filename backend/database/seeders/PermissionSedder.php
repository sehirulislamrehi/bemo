<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement("DELETE FROM permissions");

        DB::table('permissions')->insert([
            [
                'id' => 1,
                'key' => 'user_module',
                'display_name' => 'User Module',
                'module_id' => 1,
            ],
            [
                'id' => 2,
                'key' => 'all_user',
                'display_name' => 'All User',
                'module_id' => 1,
            ],
            [
                'id' => 3,
                'key' => 'add_user',
                'display_name' => '-- Add User',
                'module_id' => 1,
            ],
            [
                'id' => 4,
                'key' => 'edit_user',
                'display_name' => '-- Edit User',
                'module_id' => 1,
            ],
            [
                'id' => 5,
                'key' => 'reset_password',
                'display_name' => '-- Reset Password',
                'module_id' => 1,
            ],
            [
                'id' => 6,
                'key' => 'settings',
                'display_name' => 'Setting Module',
                'module_id' => 2,
            ],
            [
                'id' => 7,
                'key' => 'app_info',
                'display_name' => '-- App Info',
                'module_id' => 2,
            ],
            [
                'id' => 8,
                'key' => 'product_module',
                'display_name' => 'Product Module',
                'module_id' => 3,
            ],
            [
                'id' => 9,
                'key' => 'year',
                'display_name' => 'All Year',
                'module_id' => 3,
            ],
            [
                'id' => 10,
                'key' => 'add_year',
                'display_name' => '-- Add Year',
                'module_id' => 3,
            ],
            [
                'id' => 11,
                'key' => 'edit_year',
                'display_name' => '-- Edit Year',
                'module_id' => 3,
            ],
            [
                'id' => 12,
                'key' => 'view_year',
                'display_name' => '-- View Year',
                'module_id' => 3,
            ],
            [
                'id' => 13,
                'key' => 'model',
                'display_name' => 'Model',
                'module_id' => 3,
            ],
            [
                'id' => 14,
                'key' => 'add_model',
                'display_name' => '-- Add Model',
                'module_id' => 3,
            ],
            [
                'id' => 15,
                'key' => 'edit_model',
                'display_name' => '-- Edit Model',
                'module_id' => 3,
            ],
            [
                'id' => 16,
                'key' => 'view_model',
                'display_name' => '-- View Model',
                'module_id' => 3,
            ],
            [
                'id' => 17,
                'key' => 'brand',
                'display_name' => 'Brand',
                'module_id' => 3,
            ],
            [
                'id' => 18,
                'key' => 'add_brand',
                'display_name' => '-- Add Brand',
                'module_id' => 3,
            ],
            [
                'id' => 19,
                'key' => 'edit_brand',
                'display_name' => '-- Edit Brand',
                'module_id' => 3,
            ],
            [
                'id' => 20,
                'key' => 'view_brand',
                'display_name' => '-- View Brand',
                'module_id' => 3,
            ],
            [
                'id' => 21,
                'key' => 'product_type',
                'display_name' => 'Product Type',
                'module_id' => 3,
            ],
            [
                'id' => 22,
                'key' => 'add_product_type',
                'display_name' => '-- Add Product Type',
                'module_id' => 3,
            ],
            [
                'id' => 23,
                'key' => 'edit_product_type',
                'display_name' => '-- Edit Product Type',
                'module_id' => 3,
            ],
            [
                'id' => 24,
                'key' => 'view_product_type',
                'display_name' => '-- View Product Type',
                'module_id' => 3,
            ],
            [
                'id' => 25,
                'key' => 'classes',
                'display_name' => 'All Class',
                'module_id' => 3,
            ],
            [
                'id' => 26,
                'key' => 'add_classes',
                'display_name' => '-- Add Class',
                'module_id' => 3,
            ],
            [
                'id' => 27,
                'key' => 'edit_classes',
                'display_name' => '-- Edit Class',
                'module_id' => 3,
            ],
            [
                'id' => 28,
                'key' => 'view_classes',
                'display_name' => '-- View Class',
                'module_id' => 3,
            ],
            [
                'id' => 29,
                'key' => 'system_data_module',
                'display_name' => 'System Data Module',
                'module_id' => 4,
            ],
            [
                'id' => 30,
                'key' => 'coupon',
                'display_name' => 'Coupon',
                'module_id' => 4,
            ],
            [
                'id' => 31,
                'key' => 'add_coupon',
                'display_name' => '-- Add Coupon',
                'module_id' => 4,
            ],
            [
                'id' => 32,
                'key' => 'edit_coupon',
                'display_name' => '-- Edit Coupon',
                'module_id' => 4,
            ],
            [
                'id' => 33,
                'key' => 'view_coupon',
                'display_name' => '-- View Coupon',
                'module_id' => 4,
            ],
            [
                'id' => 34,
                'key' => 'validity',
                'display_name' => 'Validity',
                'module_id' => 4,
            ],
            [
                'id' => 35,
                'key' => 'add_validity',
                'display_name' => '-- Add Validity',
                'module_id' => 4,
            ],
            [
                'id' => 36,
                'key' => 'edit_validity',
                'display_name' => '-- Edit Validity',
                'module_id' => 4,
            ],
            [
                'id' => 37,
                'key' => 'view_validity',
                'display_name' => '-- View Validity',
                'module_id' => 4,
            ],
            [
                'id' => 38,
                'key' => 'packages',
                'display_name' => 'Package',
                'module_id' => 1,
            ],
            [
                'id' => 39,
                'key' => 'add_packages',
                'display_name' => '-- Add Package',
                'module_id' => 1,
            ],
            [
                'id' => 40,
                'key' => 'edit_packages',
                'display_name' => '-- Edit Package',
                'module_id' => 1,
            ],
            [
                'id' => 41,
                'key' => 'view_packages',
                'display_name' => '-- View Package',
                'module_id' => 1,
            ],
            [
                'id' => 42,
                'key' => 'visitor',
                'display_name' => 'All Visitor',
                'module_id' => 6,
            ],
            [
                'id' => 43,
                'key' => 'edit_visitor',
                'display_name' => '-- Edit User',
                'module_id' => 6,
            ],
            [
                'id' => 44,
                'key' => 'reset_password_visitor',
                'display_name' => '-- Reset Password',
                'module_id' => 6,
            ],
            [
                'id' => 45,
                'key' => 'conditions',
                'display_name' => 'Condition',
                'module_id' => 3,
            ],
            [
                'id' => 46,
                'key' => 'add_conditions',
                'display_name' => '-- Add Condition',
                'module_id' => 3,
            ],
            [
                'id' => 47,
                'key' => 'edit_conditions',
                'display_name' => '-- Edit Condition',
                'module_id' => 3,
            ],
            [
                'id' => 48,
                'key' => 'view_conditions',
                'display_name' => '-- View Condition',
                'module_id' => 3,
            ],
            [
                'id' => 49,
                'key' => 'price_tagline',
                'display_name' => 'Price Tagline',
                'module_id' => 3,
            ],
            [
                'id' => 50,
                'key' => 'add_price_tagline',
                'display_name' => '-- Add Price Tagline',
                'module_id' => 3,
            ],
            [
                'id' => 51,
                'key' => 'edit_price_tagline',
                'display_name' => '-- Edit Price Tagline',
                'module_id' => 3,
            ],
            [
                'id' => 52,
                'key' => 'view_price_tagline',
                'display_name' => '-- View Price Tagline',
                'module_id' => 3,
            ],
            [
                'id' => 53,
                'key' => 'all_product',
                'display_name' => 'All Product',
                'module_id' => 3,
            ],
            [
                'id' => 54,
                'key' => 'edit_product',
                'display_name' => '-- Edit Product',
                'module_id' => 3,
            ],
            [
                'id' => 55,
                'key' => 'all_query',
                'display_name' => 'All Query',
                'module_id' => 3,
            ],
            [
                'id' => 56,
                'key' => 'delete_query',
                'display_name' => '-- Delete Query',
                'module_id' => 3,
            ],
            [
                'id' => 57,
                'key' => 'all_blog',
                'display_name' => 'All Vlog',
                'module_id' => 4,
            ],
            [
                'id' => 58,
                'key' => 'add_blog',
                'display_name' => '-- Add Vlog',
                'module_id' => 4,
            ],
            [
                'id' => 59,
                'key' => 'edit_blog',
                'display_name' => '-- Edit Vlog',
                'module_id' => 4,
            ],
            [
                'id' => 60,
                'key' => 'pages',
                'display_name' => 'Pages',
                'module_id' => 2,
            ],
            [
                'id' => 61,
                'key' => 'add_page',
                'display_name' => '-- Add New Pages',
                'module_id' => 2,
            ],
            [
                'id' => 62,
                'key' => 'edit_page',
                'display_name' => '-- Edit Pages',
                'module_id' => 2,
            ],
            [
                'id' => 63,
                'key' => 'feature_image',
                'display_name' => 'Feature Image',
                'module_id' => 2,
            ],
            [
                'id' => 64,
                'key' => 'add_feature_image',
                'display_name' => '-- Add Feature Image',
                'module_id' => 2,
            ],
            [
                'id' => 65,
                'key' => 'edit_feature_image',
                'display_name' => '-- Edit Feature Image',
                'module_id' => 2,
            ],
            [
                'id' => 66,
                'key' => 'delete_feature_image',
                'display_name' => '-- Delete Feature Image',
                'module_id' => 2,
            ],
            [
                'id' => 67,
                'key' => 'contact_module',
                'display_name' => 'Contact Module',
                'module_id' => 5,
            ],
            [
                'id' => 68,
                'key' => 'all_message',
                'display_name' => 'All Message',
                'module_id' => 5,
            ],
            [
                'id' => 69,
                'key' => 'delete_message',
                'display_name' => '-- Delete Message',
                'module_id' => 5,
            ],
            [
                'id' => 70,
                'key' => 'all_subscriber',
                'display_name' => 'All Subscriber',
                'module_id' => 5,
            ],
            [
                'id' => 71,
                'key' => 'delete_subscriber',
                'display_name' => '-- Delete Subscriber',
                'module_id' => 5,
            ],
            [
                'id' => 72,
                'key' => 'all_event',
                'display_name' => 'All Event',
                'module_id' => 4,
            ],
            [
                'id' => 73,
                'key' => 'add_event',
                'display_name' => '-- Add Event',
                'module_id' => 4,
            ],
            [
                'id' => 74,
                'key' => 'edit_event',
                'display_name' => '-- Edit Event',
                'module_id' => 4,
            ],
            [
                'id' => 75,
                'key' => 'delete_event',
                'display_name' => '-- Delete Event',
                'module_id' => 4,
            ],
            [
                'id' => 76,
                'key' => 'all_category',
                'display_name' => 'All Category',
                'module_id' => 3,
            ],
            [
                'id' => 77,
                'key' => 'add_category',
                'display_name' => '-- Add Category',
                'module_id' => 3,
            ],
            [
                'id' => 78,
                'key' => 'edit_category',
                'display_name' => '-- Edit Category',
                'module_id' => 3,
            ],
            [
                'id' => 79,
                'key' => 'testimonials',
                'display_name' => 'Testimonials',
                'module_id' => 4,
            ],
            [
                'id' => 80,
                'key' => 'add_testimonials',
                'display_name' => '-- Add Testimonials',
                'module_id' => 4,
            ],
            [
                'id' => 81,
                'key' => 'edit_testimonials',
                'display_name' => '-- Edit Testimonials',
                'module_id' => 4,
            ],
            [
                'id' => 82,
                'key' => 'delete_testimonials',
                'display_name' => '-- Delete Testimonials',
                'module_id' => 4,
            ],
            [
                'id' => 83,
                'key' => 'view_testimonials',
                'display_name' => '-- View Testimonials',
                'module_id' => 4,
            ]
        ]);
    }
}