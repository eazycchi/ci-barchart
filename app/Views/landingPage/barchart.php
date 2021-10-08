<?= $this->extend('templates/index'); ?>

<?= $this->section('page_content'); ?>

    <main class="main-content" id="app">
        <section class="">
        <div class="container">
            <h1 id="main-title" class=" text-center">Pembuatan <i>Bar Chart Race</i></h1>
            <div class="card border">
            <div class="card-body">
                <div class="row">
                <div class="col-lg-6">
                    <form @submit="checkForm">
                    <div v-if="errors.length">
                        <b>Terdapat error(s) :</b>
                        <ul>
                        <li v-for="error in errors">(( error ))</li>
                        </ul>
                    </div>
                    <div class="form-group">
                        <label for="customFile">CSV file</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" @change="loadFile"
                                accept=".csv, text/plain, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                aria-describedby="passwordHelpBlock">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            <a href="#myModal" data-toggle="modal">format CSV yang dapat digunakan</a>
                        </small>

                        <label class="custom-file-label" for="customFile" ref="filelabel">((fileplaceholder))</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="duration">Durasi animasi (dalam detik) :</label>
                        <input id="duration" v-model="duration" class="form-control" type="number" name="duration" min="0">
                    </div>
                    <div class="form-group">
                        <label for="top_n">Banyak batang yang dapat dilihat :</label>
                        <input id="top_n" v-model="top_n" class="form-control" type="number" name="top_n" min="0">
                    </div>
                    <div class="form-group">
                        <label for="title">Judul Bar Chart</label>
                        <input id="title" v-model="title" class="form-control" type="text" name="title">
                    </div>
                    <div class="form-group text-center">
                        <button type="button" v-if="!csv_data" class="btn btn-outline-primary disabled">Buat Bar Chart Race</button>
                        <button type="submit" v-if="csv_data" class="btn btn-primary">Buat Bar Chart Race</button>
                    </div>
                    </form>
                </div>
                <div class="col-lg-6 border-left d-lg-block">
                    <label for="">Contoh files</label>
                    <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>Data Ekspor Provinsi Lampung berdasarkan Tahun (Januari 2015 - Agustus 2021)</td>
                        <td><a href="#" @click.prevent="loadExample('20152021tahun')">Pilih</a></td>
                        <td><a href="assets/datasets/20152021tahun.csv">Download</a></td>
                    </tr>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
            <hr>
            <div id="chart-card" class="card">
            <div class="card-body position-relative">
                <div class="text-right mb-4">
                <button type="button" class="btn btn-xs btn-outline-primary" v-on:click="stopRace">Stop</button>
                <button type="button" class="btn btn-xs btn-outline-primary" v-on:click="checkForm">Restart</button>
                </div>
                <h5 class="card-title" id="graph-title">((title))</h5>
                <div id="chartDiv" style="width:100%; height: 650px"></div>
                <p style="position:absolute;top:50%;left:50%;font-size:1.125rem;transform: translate(-50%,-50%)" v-if="interval == null">Please upload data first</p>
            </div>
            </div>
        </div>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">Ketentuan Format File CSV</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>File harus berformat CSV. <br>
                Kolom pertama harus berupa tahun, <span class="font-weight-bold">YYYY</span>.</p>
                <p><span class="font-weight-bold">Opsi 1 :</span> kolom pertama untuk tahun, dan selanjutnya variabel</p>
                <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>Date</th>
                    <th>Name1</th>
                    <th>Name2</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>2018</td>
                    <td>1</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>2018</td>
                    <td>2</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>2018</td>
                    <td>4</td>
                    <td>7</td>
                </tr>
                </tbody>
                </table>
                <p><span class="font-weight-bold">Opsi 2 :</span> kolom pertama tahun dan kolom kedua variabel, kolom ketiga berupa value</p>
                <table class="table">
                <thead class="thead-light">
                <tr>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>2018</td>
                    <td>Name1</td>
                    <td>1</td>
                </tr>
                <tr>
                    <td>2018</td>
                    <td>Name2</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>2018</td>
                    <td>Name1</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>2018</td>
                    <td>Name2</td>
                    <td>3</td>
                </tr>
                <tr>
                    <td>2018</td>
                    <td>Name1</td>
                    <td>4</td>
                </tr>
                <tr>
                    <td>2018</td>
                    <td>Name2</td>
                    <td>7</td>
                </tr>
                </tbody>
                </table>

            </div>
            </div>
        </div>
        </div>

    </main>

<!-- Kumpulan Script Barchart -->   
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/4.1.2/papaparse.min.js"></script>
    <script src="https://d3js.org/d3.v5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.15/lodash.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="assets/js/barchartrace.js"></script>
    <script>
      const app = new Vue({
          el: '#app',
          data: {
              errors: [],
              file: null,
              csv_data: null,
              interval: null,
              duration: 20,
              tickDuration: 500,
              top_n: 10,
              title: "Bar Chart Race",
              fileplaceholder: "Choose file"
          },
          methods: {
              loadExample: function (setting_name) {
                  var self = this;
                  self.duration = settings[setting_name].duration;
                  self.top_n = settings[setting_name]['top_n'];
                  self.title = settings[setting_name].title;
                  Papa.parse(settings[setting_name].url, {
                          download: true,
                          header: true,
                          skipEmptyLines: true,
                          complete: function (results) {
                              if (Object.keys(results.data[0]).length === 3) {
                                  results.data = reshapeData(results.data)
                              }
                              self.csv_data = results.data;
                          }
                      }
                  )
              },
              loadFile: function (e) {
                  var self = this;
                  this.file = e.target.files[0];
                  this.fileplaceholder = this.file.name;
                  Papa.parse(self.file, {
                      header: true,
                      skipEmptyLines: true,
                      complete: function (results) {
                          if (Object.keys(results.data[0]).length === 3) {
                              results.data = reshapeData(results.data)
                          }
                          self.csv_data = results.data;
                          self.top_n = Math.min(20, Object.keys(self.csv_data[0]).length - 1)
                      }
                  });


              },
              stopRace: function () {
                  if (!this.interval) {
                      return
                  } else {
                      this.interval.stop()
                  }
              },
              checkForm: function (e) {
                  var self = this;
                  if (self.interval !== null) {
                      self.interval.stop()
                  }
                  if (!this.csv_data) {
                      return
                  }
                  if (self.tickDuration && self.top_n) {
                      e.preventDefault();
                      this.top_n = parseInt(self.top_n);
                      this.duration = parseInt(self.duration);
                      this.tickDuration = self.duration / self.csv_data.length * 1000
                      let chartDiv = document.getElementById("chartDiv");
                      var data = JSON.parse(JSON.stringify(self.csv_data))
                      self.interval = createBarChartRace(data, self.top_n, self.tickDuration);
                  }

                  self.errors = [];

                  if (!self.csv_data) {
                      self.errors.push('csv file is required');
                  }
                  if (!self.tickDuration) {
                      self.errors.push('Time between frames required.');
                  }
                  if (!self.top_n) {
                      self.errors.push('Number of bars to display required.');
                  }
                  e.preventDefault();
                  window.scrollTo({top: $("#chart-card").offset().top - 10, behavior: 'smooth'});
              }
          },
          delimiters: ["((", "))"]

      });


      /*
      reshapes the data from the second accepted csv format to the other :
      (one row per contender and per date) => (one row per date (ordered) and one column per contender.)
      */
      function reshapeData(data) {
          // groupby dates (first column)
          column_names = new Set(data.map(x => x[Object.keys(x)[1]]));
          const grouped_by_date = _.groupBy(data, (e) => e[Object.keys(e)[0]]);
          return Object.keys(grouped_by_date).sort().map((k) => {
              item = {'date': k};
              column_names.forEach((n) => item[n] = 0);
              grouped_by_date[k].forEach((e) => item[e[Object.keys(e)[1]]] = e[Object.keys(e)[2]]);
              return item
          })

      }

      // settings for the example data
      const settings = {
          "20152021tahun": {
              "duration": 24,
              "top_n": 12,
              "title": "Data Ekspor Provinsi Lampung berdasarkan Tahun (Januari 2015 - Agustus 2021)",
              "url": "https://raw.githubusercontent.com/eazycchi/animatedBarChart/main/datasets/20152021tahun.csv"
          },
      }
  </script>

<?= $this->endSection(); ?>
