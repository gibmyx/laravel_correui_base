<?php


namespace App\Providers;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilters
{
    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;
    /**
     * The builder instance.
     *
     * @var Builder
     */
    protected $builder;

    /**
     * Apply the filters to the builder.
     *
     * @param  Builder $builder
     * @return Builder
     */
    function apply(Builder $builder, $clause)
    {
        $this->builder = $builder;

        foreach (array_filter($clause) as $key => $value) {
            if (method_exists($this, $key)) {

                call_user_func_array([$this, $key], array_filter([$value]));
            }
        }

        return $this->builder;
    }

    /**
     * @param $value
     * @return array
     */
    protected function get_value($value)
    {
        return is_array($value) ? $value : [$value];
    }

    /**
     * @param $value
     * @return Carbon
     */
    protected function get_date_value($value)
    {
        return Carbon::createFromFormat('d/m/Y', $value);
    }
}
