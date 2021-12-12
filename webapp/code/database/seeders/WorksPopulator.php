<?php


namespace Database\Seeders;

use Eloquent;
use DB;
use Illuminate\Database\Seeder;

class WorksPopulator extends Seeder
{
    private function populateWorks(){
        /// Get zipped titles file

        // Disable SSL verification. SOMEWHAT DANGEROUS
        $stream_opts=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );  
        
        $zippedFileOrigin = 'https://dumps.wikimedia.org/ptwiki/latest/ptwiki-latest-all-titles.gz';
        $zippedFileDestination = tempnam("/tmp", "titles_zipped_");
        
        $zippedData = file_get_contents($zippedFileOrigin, false, stream_context_create($stream_opts));
        $zippedFileOut = fopen($zippedFileDestination, 'wb');
        fwrite($zippedFileOut, $zippedData);
        fclose($zippedFileOut);

        $this->command->info('DB: Works: Got zipped file');

        /// Unzip titles file

        $titlesFilePath = tempnam("/tmp", "titles_");

        $gzReader = gzopen($zippedFileDestination, 'rb');
        $gzOutput = fopen($titlesFilePath, 'wb');

        $bufferSize = 4096;
        while(!gzeof($gzReader)){
            fwrite($gzOutput, gzread($gzReader, $bufferSize));
        }

        fclose($gzOutput);
        gzclose($gzReader);

        $this->command->info('DB: Works: Unzipped file');

        /// Process titles file
        $titles = [];

        $titlesFile = fopen($titlesFilePath, 'r');
        fgets($titlesFile);
        while(($line = fgets($titlesFile)) != false){
            $title = trim(explode("\t", $line)[1]);
            $titles[] = $title;
        }
        fclose($titlesFile);

        $numTitles = count($titles);

        $this->command->info('DB: Works: Processed titles');

        /// Add titles to DB
        $begin_t = microtime(true);

        $batchSize = 10000;
        for($i = 0; $i < $numTitles; $i += $batchSize){
            $percent = number_format(100.0 * $i/$numTitles, 1);
            $this->command->info("DB: Works: Inserting titles - $percent% ($i/$numTitles)");
            $thisBatchSize = min($batchSize, count($titles) - $i);
            $query =
                "INSERT INTO work(title) VALUES (?)" .
                str_repeat(", (?)", $thisBatchSize-1);
            DB::insert($query, array_slice($titles, $i, $thisBatchSize));
        }

        $dt = microtime(true) - $begin_t;

        $this->command->info("DB: Works: Added titles in $dt seconds");

        unlink($zippedFileDestination);
        unlink($titlesFilePath);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->populateWorks();
        $this->command->info('DB: Works table seeded!');
    }
}
