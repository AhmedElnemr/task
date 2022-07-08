<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Collection;
use Illuminate\Database\Query\Builder;

class LangServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {


        //from main directly
        Collection::macro('CollectionTranslate', function ($arr,$lang) {
            Collection::transform(function ($item) use($arr,$lang){
                foreach ($arr as $value) {
                    $item_return =  'trans_' . $value;
                    $item->{$item_return} = $item->getTranslation($value,$lang);
                }
                return $item;
            });
         });


        //from main to single relation
        Collection::macro('RelationTranslateForOneToOne', function ($arr,$lang,$relationName) {
            Collection::transform(function ($item) use($arr,$lang,$relationName){
                foreach ($arr as $return_column) {
                    $column = 'trans_' . $return_column;
                    if ($relationName && $item->{$relationName} !=null){
                        $item->{$relationName}->{$column}=$item->{$relationName}->getTranslation($return_column,$lang);
                    }
                }
                return $item;
            });
        });

        //from main to many
        Collection::macro('RelationTranslateManyRelations', function ($arr,$lang,$relationName) {
            Collection::transform(function ($item) use($arr,$lang,$relationName){
                foreach ($arr as $return_column) {
                    $column =  'trans_' . $return_column;
                    if ($relationName &&$item->{$relationName} !=null ){
                        $item->{$relationName}->transform(function ($item)use($arr,$lang,$relationName,$return_column,$column){
                            $item->{$column}=$item->getTranslation($return_column,$lang);
                            return $item;
                        });
                    }
                }
                return $item;
            });
        });


        //from main to many to single
        Collection::macro('RelationTranslateForOneToManyToOne', function ($arr,$lang,$relationName,$child_relation) {
            Collection::transform(function ($item) use($arr,$lang,$relationName,$child_relation){
                foreach ($arr as $return_column) {
                    $column =  'trans_' . $return_column;
                    if ($relationName &&$item->{$relationName} !=null ){
                        $item->{$relationName}->transform(function ($item)use($arr,$lang,$relationName,$child_relation,$return_column,$column){
                            if ($child_relation && $item->{$child_relation} !=null){
                                $item->{$child_relation}->{$column}=$item->{$child_relation}->getTranslation($return_column,$lang);
                            }
                            return $item;
                        });
                    }
                }
                return $item;
            });
        });



        //from main to many to single to single
        Collection::macro('RelationTranslateForOneToManyToOneToOne', function ($arr,$lang,$relationName,$child_relation,$sub_relation) {
            Collection::transform(function ($item) use($arr,$lang,$relationName,$child_relation,$sub_relation){
                foreach ($arr as $return_column) {
                    $column =  'trans_' . $return_column;
                    if ($relationName &&$item->{$relationName} !=null ){
                        $item->{$relationName}->transform(function ($item)use($arr,$lang,$relationName,$child_relation,$sub_relation,$return_column,$column){
                            if ($child_relation && $item->{$child_relation} !=null){

                                if ($sub_relation && $item->{$child_relation}->{$sub_relation} !=null){
                                    $item->{$child_relation}->{$sub_relation}->{$column}=$item->{$child_relation}->{$sub_relation}->getTranslation($return_column,$lang);
                                }
                            }
                            return $item;
                        });
                    }
                }
                return $item;
            });
        });




        //from main to single relation to single relation
        Collection::macro('RelationTranslateForOneToOneInRelation', function ($arr,$lang,$relationName,$child_relation) {
            Collection::transform(function ($item) use($arr,$lang,$relationName,$child_relation){
                foreach ($arr as $return_column) {
                    $column =   'trans_' . $return_column;
                    if ($relationName && $item->{$relationName} !=null){
                        if (!is_null($item->{$relationName}->{$child_relation})) {
                            $item->{$relationName}->{$child_relation}->{$column} = $item->{$relationName}->{$child_relation}->getTranslation($return_column,$lang);
                            return $item;
                        }
                    }
                }
                return $item;
            });

        });

        //single_first->single_second->multi_third->single_fourth
        //from main to single relation to multi relation to single relation
        Collection::macro('RelationTranslateForOneToManyToOneInRelation', function ($arr,$lang,$relationName,$child_relation,$sub_child) {
            Collection::transform(function ($item) use($arr,$lang,$relationName,$child_relation,$sub_child){
                foreach ($arr as $return_column) {
                    $column =   'trans_' . $return_column;
                    if ($relationName && $item->{$relationName} !=null){
                        if (!is_null($item->{$relationName}->{$child_relation})) {
                            $item->{$relationName}->{$child_relation}->transform(function ($item)use($arr,$lang,$relationName,$child_relation,$sub_child,$return_column,$column){
                                if (!is_null($item->{$sub_child})) {
                                    $item->{$sub_child}->{$column} = $item->{$sub_child}->getTranslation($return_column,$lang);

                                }
                                return $item;
                            });
                        }
                    }
                }
                return $item;
            });

        });


        //main to many to one to many to one
        Collection::macro('RelationTranslateForManyToOneToManyToOneInRelation', function ($arr,$lang,$relationName,$child_relation,$sub_child,$sub_sub) {
            Collection::transform(function ($item) use($arr,$lang,$relationName,$child_relation,$sub_child,$sub_sub){
                foreach ($arr as $return_column) {
                    $column =   'trans_' . $return_column;
                    if ($relationName && $item->{$relationName} !=null){

                        $item->{$relationName}->transform(function ($item)use($arr,$lang,$relationName,$child_relation,$sub_child,$sub_sub,$return_column,$column) {

                            if (!is_null($item->{$child_relation})) {
                                if (!is_null($item->{$child_relation}->{$sub_child})) {
                                    $item->{$child_relation}->{$sub_child}->transform(function ($item)use($arr,$lang,$relationName,$child_relation,$sub_child,$sub_sub,$return_column,$column){
                                        if (!is_null($item->{$sub_sub})) {
                                            $item->{$sub_sub}->{$column} = $item->{$sub_sub}->getTranslation($return_column,$lang);
                                        }
                                        return $item;
                                    });
                                }
                            }

                            return $item;
                        });

                    }
                }
                return $item;
            });

        });


        //main to many to one to many to one to one
        Collection::macro('RelationTranslateForManyToOneToManyToOneToOneInRelation', function ($arr,$lang,$relationName,$child_relation,$sub_child,$sub_sub,$sub_sub_sub) {
            Collection::transform(function ($item) use($arr,$lang,$relationName,$child_relation,$sub_child,$sub_sub,$sub_sub_sub){
                foreach ($arr as $return_column) {
                    $column =   'trans_' . $return_column;
                    if ($relationName && $item->{$relationName} !=null){

                        $item->{$relationName}->transform(function ($item)use($arr,$lang,$relationName,$child_relation,$sub_child,$sub_sub,$sub_sub_sub,$return_column,$column) {

                            if (!is_null($item->{$child_relation})) {
                                if (!is_null($item->{$child_relation}->{$sub_child})) {
                                    $item->{$child_relation}->{$sub_child}->transform(function ($item)use($arr,$lang,$relationName,$child_relation,$sub_child,$sub_sub,$sub_sub_sub,$return_column,$column){
                                        if (!is_null($item->{$sub_sub})) {
                                            if (!is_null($item->{$sub_sub}->{$sub_sub_sub})) {
                                                $item->{$sub_sub}->{$sub_sub_sub}->{$column} = $item->{$sub_sub}->{$sub_sub_sub}->getTranslation($return_column,$lang);

                                            }
                                        }
                                        return $item;
                                    });
                                }
                            }

                            return $item;
                        });

                    }
                }
                return $item;
            });

        });


        //from main to many to  many to single relation
        Collection::macro('RelationTranslateForManyToManyToOneInRelation', function ($arr,$lang,$relationName,$child_relation,$sub_child) {
            Collection::transform(function ($item) use($arr,$lang,$relationName,$child_relation,$sub_child){
                foreach ($arr as $return_column) {
                    $column =   'trans_' . $return_column;
                    if ($relationName && $item->{$relationName} !=null){

                        $item->{$relationName}->transform(function ($item)use($arr,$lang,$relationName,$child_relation,$sub_child,$return_column,$column) {

                            if (!is_null($item->{$child_relation})) {
                                $item->{$child_relation}->transform(function ($item)use($arr,$lang,$relationName,$child_relation,$sub_child,$return_column,$column){
                                    if (!is_null($item->{$sub_child})) {
                                        $item->{$sub_child}->{$column} = $item->{$sub_child}->getTranslation($return_column,$lang);

                                    }
                                    return $item;
                                });
                            }

                            return $item;
                        });

                    }
                }
                return $item;
            });

        });

    }//end fun
}//end class
