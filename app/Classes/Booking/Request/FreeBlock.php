<?php

namespace App\Classes\Booking\Request;

use Illuminate\Support\Collection;
use App\Repository\Blocks as BlocksRepository;

class FreeBlock extends BookingRequest
{
    protected const BLOCK_VOLUME = 2;

    protected int $block_volume;

    protected Collection $free_blocks;

    public function __construct(int $block_volume = 2)
    {
        $this->block_volume = $block_volume;
    }

    /**
     * Get a free blocks collection.
     *
     * @return Collection
     */
    public function blocks(): Collection
    {
        return $this->free_blocks;
    }

    /**
     * Make a calculation: do we have enough quantify of ree blocks for the user request.
     *
     * @param Collection $suitable_buildings
     * @param int $required_volume
     * @param string $start_date
     * @return bool
     */
    public function check(Collection $suitable_buildings, int $required_volume, string $start_date): bool
    {
        $required_blocks = $this->getNumberOfRequiredBlocks($required_volume);

        $this->free_blocks = (new BlocksRepository())->getFree(
            $suitable_buildings, $start_date
        );

        return $this->free_blocks->count() >= $required_blocks;
    }

    /**
     * Simple helper to calculate number of requred blocks.
     *
     * @param int $volume
     * @return int
     */
    protected function getNumberOfRequiredBlocks(int $volume): int
    {
        return ceil($volume/$this->block_volume);
    }
}
