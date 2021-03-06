<?php
declare(strict_types=1);

namespace CodeShopping\Firebase;

use Kreait\Firebase;
use Kreait\Firebase\Database\Reference;

trait FirebaseSync
{
    public static function bootFirebaseSync()
    {
        static::created(function ($model) {
            $model->syncFbCreate();
        });
        static::updated(function ($model) {
            $model->syncFbUpdate();
        });
        static::deleted(function ($model) {
            $model->syncFbRemove();
        });
        if (method_exists(__CLASS__, 'pivotAttached')) {
            static::pivotAttached(function ($model, $relationName, $pivotIds, $pivtIdsAttribute) {
                $model->syncPivotAttached($model, $relationName, $pivotIds, $pivtIdsAttribute);
            });
        };
    }

    protected function syncFbCreate(){
        $this->syncFbSet();
    }

    protected function syncFbUpdate(){
        $this->syncFbSet();
    }

    protected function syncFbSet(){
        $this->getModelReference()->update($this->toArray());
    }

    protected function syncFbRemove(){
        $this->getModelReference()->remove();
    }

    protected function syncPivotAttached($model, $relationName, $pivotIds, $pivtIdsAttribute){
        throw new \Exception('Not implemented');
    }

    protected function getModelReference(): Reference
    {
        $path = $this->getTable() . '/' . $this->getKey();
        return $this->getFirebaseDatabase()->getReference($path);
    }

    protected function getFirebaseDatabase(): Firebase\Database
    {
        $firebase = app(Firebase::class);
        return $firebase->getDatabase();
    }

}